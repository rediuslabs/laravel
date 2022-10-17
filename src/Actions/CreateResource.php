<?php

namespace Redius\Actions;

use Illuminate\Support\Facades\Log;

class CreateResource extends Action
{
    public function __construct(string $label = 'Create')
    {
        parent::__construct($label, fn () => Log::debug('CreateResource'));
    }
}
