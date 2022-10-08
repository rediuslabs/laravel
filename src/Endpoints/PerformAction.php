<?php

namespace Redius\Endpoints;

use Illuminate\Routing\Controller;
use Redius\Requests\ActionRequest;

class PerformAction extends Controller
{
    public function __invoke(ActionRequest $request)
    {
        return [];
    }
}
