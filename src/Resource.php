<?php

namespace Redius;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Redius\Contracts\ResourceInterface;
use Redius\Contracts\TransformerInterface;
use Redius\Exceptions\ResourceModelNotFoundException;
use Redius\Transformers\ClosureTransformer;

abstract class Resource implements ResourceInterface
{
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
                return $model->map(fn ($model) => $this->transform($model))->toArray();
            }

            if ($model instanceof Model) {
                return $model->toArray();
            }

            return $model;
        });
    }

    abstract public function fields(): array;
}
