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
    public static function make(Closure|EloquentScope|string $scope, ?string $label = null): static
    {
        return new static($scope, $label);
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
    public function __construct(protected Closure|EloquentScope|string $scope, protected ?string $label = null)
    {
        if ($this->scope instanceof self) {
            $this->scope = $this->scope->scope;
            $this->label = $this->scope->label;
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
    }

    public function id(): string
    {
        return \is_string($this->scope) ? Str::slug($this->scope) : \spl_object_id($this->scope);
    }

    public function is(string $id): bool
    {
        return $this->id() === $id;
    }

    public function name(?string $label = null): string|static
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
