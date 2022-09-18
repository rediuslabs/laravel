<?php

namespace Redius\Controllers;

use function app;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function is_callable;
use Redius\Contracts\ResourceInterface;

class ListResources
{
    use BuildResourceResponse;

    public function __invoke(Request $request, ResourceInterface $resource): JsonResponse
    {
        if (is_callable([$resource, 'index'])) {
            return $resource->index($request);
        }

        $paginator = app($resource->model())->paginate($request->get('per_page', 15));

        return $this->buildCollectionResponse($paginator, $resource->transformer(), Str::plural($resource->name()));
    }
}
