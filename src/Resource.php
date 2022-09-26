<?php

namespace Redius;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope as EloquentScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Redius\Contracts\ResourceInterface;
use Redius\Contracts\TransformerInterface;
use Redius\Exceptions\ResourceModelNotFoundException;
use Redius\Transformers\ClosureTransformer;

abstract class Resource implements ResourceInterface
{
    protected bool $defaultScope = true;

    public function name(): string
    {
        return Str::snake(class_basename($this));
    }

    /**
     * @throws ResourceModelNotFoundException
     */
    public function model(): string
    {
        $namespace = 'App\\Models\\';
        $basename = Str::studly(Str::singular($this->name()));

        return match (true) {
            \class_exists("App\\Models\\{$basename}") => "App\\Models\\{$basename}",
            \class_exists("App\\{$basename}") => "App\\Models\\{$basename}",
            default => throw ResourceModelNotFoundException::make($basename),
        };
    }

    /**
     * @throws ResourceModelNotFoundException
     */
    public function query(): Builder
    {
        return app($this->model())->query();
    }

    public function label(): string
    {
        return Str::title($this->name());
    }

    public function icon(): ?string
    {
        return null;
    }

    public function actions(): array
    {
        return [];
    }

    public function filters(): array
    {
        return [];
    }

    public function scopes(): array
    {
        return [];
    }

    public function middlewares(): array
    {
        return [];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function transformer(): TransformerInterface
    {
        return ClosureTransformer::make(function (array|Collection|Model $model) {
            if ($model instanceof Collection) {
                return $model->map->toArray();
            }

            if ($model instanceof Model) {
                return $model->toArray();
            }

            return $model;
        });
    }

    /**
     * @throws Exceptions\InvalidArgumentException
     */
    public function defaultScope(): ?EloquentScope
    {
        return $this->defaultScope ? Scope::default() : null;
    }

    abstract public function fields(): array;
}
