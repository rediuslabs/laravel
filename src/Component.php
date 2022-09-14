<?php

namespace Redius;

use JetBrains\PhpStorm\ArrayShape;
use Redius\Contracts\ComponentInterface;

class Component implements ComponentInterface
{
    public function __construct(protected string $name, protected array $attributes = [])
    {
        //
    }

    public function name(): string
    {
        return $this->name;
    }

    public function attributes(): array
    {
        return $this->attributes;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    #[ArrayShape(['name' => 'string', 'attributes' => 'array'])]
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'attributes' => $this->attributes,
        ];
    }

    public function toJson($options = 0): bool|string
    {
        return json_encode($this->toArray(), $options);
    }
}
