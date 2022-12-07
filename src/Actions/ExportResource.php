<?php

namespace Redius\Actions;

use Illuminate\Support\Facades\Log;
use Redius\Contracts\GlobalActionInterface;

class ExportResource extends Action implements GlobalActionInterface
{
    protected ?string $icon = 'tabler:database-export';

    public function __construct(string $label = 'Export')
    {
        parent::__construct($label, fn () => Log::debug('Export resource'));
    }
}
