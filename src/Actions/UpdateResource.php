<?php

namespace Redius\Actions;

use Illuminate\Support\Facades\Log;

class UpdateResource extends Action
{
    public function __construct(string $label = 'Update')
    {
        parent::__construct($label, fn () => Log::debug('UpdateResource'));
    }
}
