<?php

namespace Redius\Exceptions;

class ResourceModelNotFoundException extends Exception
{
    public static function make(string $model): static
    {
        return new self("Resource model [{$model}] not found.");
    }
}
