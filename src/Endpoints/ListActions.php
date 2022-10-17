<?php

namespace Redius\Endpoints;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Redius\Contracts\ResourceInterface;
use Redius\Redius;

class ListActions
{
    use BuildResourceResponse;

    public function __invoke(Request $request, ResourceInterface $resource): JsonResponse
    {
        return $this->buildCollectionResponse(Redius::actions($resource)->toArray(), null, 'actions');
    }
}
