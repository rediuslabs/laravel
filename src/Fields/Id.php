<?php

namespace Redius\Fields;

class Id extends Field
{
    public static function make(string $name = 'id', string $label = 'ID'): static
    {
        return new static($name, $label);
    }
}
