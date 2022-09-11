<?php

namespace Redius;

use Illuminate\Support\Str;
use Redius\Contracts\ResourceInterface;

abstract class Resource implements ResourceInterface
{
    public function name(): string
    {
        return Str::snake(class_basename($this));
    }

    public function model(): string
    {
        $namespace = config('redius.model_namespace');
        $basename = Str::studly(Str::singular($this->name()));

        return "{$namespace}\\{$basename}";
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

    abstract public function fields(): array;
}
