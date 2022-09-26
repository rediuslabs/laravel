<?php

namespace Redius\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Redius\Redius;
use Redius\Scope;
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

        $query = $resource->query();

        if ($request->has('scope')) {
            $scope = Redius::scope($resource, $request->get('scope'));

            if ($scope) {
                $scope->apply($query, app($resource->model()));
            }
        }

        $paginator = $query->paginate($request->get('per_page', 15));

        return $this->buildCollectionResponse($paginator, $resource->transformer(), Str::plural($resource->name()));
    }
}
