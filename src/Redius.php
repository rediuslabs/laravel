<?php

namespace Redius;

use Illuminate\Support\Str;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;

class Redius
{
    /**
     * @throws Exceptions\ResourceNotFoundException
     */
    public static function resource(string $name)
    {
        $resource = self::namespace().Str::studly(Str::singular($name));

        if (! $resource) {
            throw Exceptions\ResourceNotFoundException::make($name);
        }

        return new $resource;
    }

    public static function namespace(): string
    {
        return Str::finish(config('redius.namespace'), '\\');
    }

    public static function responseManager()
    {
        return tap(new Manager(), fn ($manager) => $manager->setSerializer(new JsonApiSerializer()));
    }
}
