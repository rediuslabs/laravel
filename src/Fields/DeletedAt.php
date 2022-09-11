<?php

namespace Redius\Fields;

class DeletedAt extends Timestamp
{
    protected string $format = 'YYYY-MM-DD HH:mm:ss';

    public static function make(string $name = 'deleted_at', string $label = 'Deleted At'): static
    {
        return parent::make($name, $label);
    }
}
