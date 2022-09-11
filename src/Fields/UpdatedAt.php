<?php

namespace Redius\Fields;

class UpdatedAt extends Timestamp
{
    protected string $format = 'YYYY-MM-DD HH:mm:ss';

    public static function make(string $name = 'updated_at', string $label = 'Updated At'): static
    {
        return parent::make($name, $label);
    }
}
