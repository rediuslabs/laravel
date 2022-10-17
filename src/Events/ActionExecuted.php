<?php

namespace Redius\Events;

use Redius\Contracts\ActionInterface;
use Redius\Contracts\ResourceInterface;
use Redius\Requests\ActionRequest;

class ActionExecuted
{
    public function __construct(public ActionInterface $action, public ResourceInterface $resource, public ActionRequest $request, public $result = null)
    {
    }
}
