<?php

namespace Redius\Actions;

class DeleteResource extends Action
{
    public function __construct(string $label = 'Delete')
    {
        parent::__construct($label, fn ($resource) => $resource->delete());
    }
}
