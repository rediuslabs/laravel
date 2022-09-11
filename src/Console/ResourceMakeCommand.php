<?php

namespace Redius\Console;

use Illuminate\Console\GeneratorCommand;

class ResourceMakeCommand extends GeneratorCommand
{
    protected $name = 'redius:resource';

    protected $description = 'Create a new Redius resource';

    protected function getStub(): string
    {
        return __DIR__.'/stubs/resource.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return parent::getDefaultNamespace($rootNamespace).'\\Redius';
    }
}
