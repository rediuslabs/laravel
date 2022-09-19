<?php

namespace Redius\Fields;

class Id extends Field
{
    protected bool $isPrimaryKey = true;

    public static function make(string $name = 'id', string $label = 'ID'): static
    {
        return new static($name, $label);
    }
}
