<?php

namespace Redius\Actions;

class BulkDeleteResource extends BulkAction
{
    public function __construct(string $label = 'Bulk Delete')
    {
        parent::__construct($label, fn ($resources) => $resources->each->delete());
    }
}
