<?php

namespace Redius\Fields;

class CreatedAt extends Timestamp
{
    protected string $format = 'YYYY-MM-DD HH:mm:ss';

    public static function make(string $name = 'created_at', string $label = 'Created At'): static
    {
        return parent::make($name, $label);
    }
}
