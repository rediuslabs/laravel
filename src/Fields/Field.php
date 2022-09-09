<?php

namespace Redius\Fields;

use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use Redius\Component;
use Redius\Contracts\ComponentInterface;
use Redius\Contracts\FieldInterface;

class Field implements FieldInterface
{
    protected array $attributes = [];

    public static function make(string $name, string $label = ''): static
    {
        return new static($name, $label);
    }

    public function __construct(protected string $name, protected string $label = '')
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function label(): string
    {
        return $this->label ?? $this->name;
    }

    public function component(): ComponentInterface
    {
        $name = Str::studly(\class_basename($this));

        return new Component("{$name}Field", $this->attributes);
    }

    #[ArrayShape(['name' => 'string', 'label' => 'string', 'component' => "\Redius\Component"])]
    public function toArray(): array
    {
        return [
            'name' => $this->name(),
            'label' => $this->label(),
            'component' => $this->component(),
        ];
    }

    public function toJson($options = 0): bool|string
    {
        return json_encode($this->toArray(), $options);
    }

    public function isSortable(): bool
    {
        return false;
    }

    public function isSearchable(): bool
    {
        return false;
    }

    public function isFilterable(): bool
    {
        return false;
    }

    public function isRequired(): bool
    {
        return false;
    }

    public function isReadonly(): bool
    {
        return false;
    }

    public function isHidden(): bool
    {
        return false;
    }

    public function isShowOnIndex(): bool
    {
        return false;
    }

    public function isShowOnDetail(): bool
    {
        return false;
    }

    public function isShowOnCreation(): bool
    {
        return false;
    }

    public function isShowOnUpdate(): bool
    {
        return false;
    }
}
