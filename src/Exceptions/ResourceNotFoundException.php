<?php

namespace Redius\Exceptions;

class ResourceNotFoundException extends Exception
{
    public static function make(string $resource): static
    {
        return new static("Resource [{$resource}] not found.");
    }
}
