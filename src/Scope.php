<?php

namespace Redius;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope as EloquentScope;
use Illuminate\Support\Str;
use Redius\Exceptions\InvalidArgumentException;

/**
 * @phpstan-consistent-constructor
 */
class Scope implements EloquentScope
{
    /**
     * @throws InvalidArgumentException
     */
    public static function make(Closure|EloquentScope|string $scope, ?string $label = null, ?string $id = null): static
    {
        return new static($scope, $label, $id);
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function default(): static
    {
        return new static(fn () => null, 'All');
    }

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(protected Closure|EloquentScope|string $scope, protected ?string $label = null, protected ?string $id = null)
    {
        if ($this->scope instanceof self) {
            return $this->scope;
        }

        if ($this->scope instanceof Closure && empty($this->label)) {
            throw new InvalidArgumentException('Scope label is required when using a closure.');
        }

        if (\is_string($this->scope)) {
            if (! \class_exists($this->scope)) {
                throw new InvalidArgumentException("Scope class [{$this->scope}] does not exist.");
            }

            $this->label ??= Str::title(Str::snake(class_basename($this->scope)));
        }

        if ($this->scope instanceof EloquentScope) {
            $this->label ??= Str::title(Str::snake(class_basename($this->scope::class)));
        }

        $this->id ??= \md5($this->label);
    }

    public function is(string $id): bool
    {
        return $this->id === $id;
    }

    public function id(?string $id = null): string|static
    {
        if (empty($id)) {
            return $this->id;
        }

        $this->id = $id;

        return $this;
    }

    public function label(?string $label = null): string|static
    {
        if (empty($label)) {
            return $this->label;
        }

        $this->label = $label;

        return $this;
    }

    public function apply(Builder $builder, Model $model)
    {
        if ($this->scope instanceof Closure) {
            ($this->scope)($builder, $model);
        } elseif ($this->scope instanceof EloquentScope) {
            $this->scope->apply($builder, $model);
        } else {
            $builder->{$this->scope}($builder, $model);
        }
    }
}
