<?php

namespace Redius\Fields;

use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use Redius\Component;
use Redius\Contracts\ComponentInterface;
use Redius\Contracts\FieldInterface;

class Field implements FieldInterface
{
    protected string $name;

    protected string $label;

    protected bool $required = false;

    protected bool $sortable = false;

    protected bool $seachable = false;

    protected bool $filterable = false;

    protected bool $readonly = false;

    protected bool $showOnIndex = true;

    protected bool $showOnDetail = true;

    protected bool $showOnCreation = true;

    protected bool $showOnUpdate = true;

    protected string $component = 'text-field';

    protected array $componentAttributes = [];

    public static function make(string $name = '', string $label = ''): static
    {
        return new static($name, $label);
    }

    public function __construct(string $name = '', string $label = '')
    {
        $this->name = $name ?: Str::snake(class_basename(static::class));
        $this->label = $label ?: Str::title($name);
    }

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function sortable(): static
    {
        $this->sortable = true;

        return $this;
    }

    public function searchable(): static
    {
        $this->seachable = true;

        return $this;
    }

    public function filterable(): static
    {
        $this->filterable = true;

        return $this;
    }

    public function required(): static
    {
        $this->required = true;

        return $this;
    }

    public function readonly(): static
    {
        $this->readonly = true;

        return $this;
    }

    public function component(string $name, array $attributes = []): static
    {
        $this->component = $name;
        $this->componentAttributes = $attributes;

        return $this;
    }

    public function showOnForms(): static
    {
        $this->showOnCreation = $this->showOnUpdate = true;

        return $this;
    }

    public function hideOnForms(): static
    {
        $this->showOnCreation = $this->showOnUpdate = false;

        return $this;
    }

    public function showOnIndex(): static
    {
        $this->showOnIndex = true;

        return $this;
    }

    public function hideOnIndex(): static
    {
        $this->showOnIndex = false;

        return $this;
    }

    public function showOnDetail(): static
    {
        $this->showOnDetail = true;

        return $this;
    }

    public function hideOnDetail(): static
    {
        $this->showOnDetail = false;

        return $this;
    }

    public function showOnCreation(): static
    {
        $this->showOnCreation = true;

        return $this;
    }

    public function hideOnCreation(): static
    {
        $this->showOnCreation = false;

        return $this;
    }

    public function showOnUpdate(): static
    {
        $this->showOnUpdate = true;

        return $this;
    }

    public function hideOnUpdate(): static
    {
        $this->showOnUpdate = false;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getComponent(): ComponentInterface
    {
        $name = Str::studly(\class_basename($this));

        return new Component("{$name}Field", $this->componentAttributes);
    }

    public function isSortable(): bool
    {
        return $this->sortable;
    }

    public function isSearchable(): bool
    {
        return $this->seachable;
    }

    public function isFilterable(): bool
    {
        return $this->filterable;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function isReadonly(): bool
    {
        return $this->readonly;
    }

    public function isShowOnIndex(): bool
    {
        return $this->showOnIndex;
    }

    public function isShowOnDetail(): bool
    {
        return $this->showOnDetail;
    }

    public function isShowOnCreation(): bool
    {
        return $this->showOnCreation;
    }

    public function isShowOnUpdate(): bool
    {
        return $this->showOnUpdate;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toJson($options = 0): bool|string
    {
        return json_encode($this->toArray(), $options);
    }

    #[ArrayShape(['name' => 'string', 'label' => 'string', 'component' => "\Redius\Component"])]
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'label' => $this->getLabel(),
            'component' => $this->getComponent(),
        ];
    }
}
