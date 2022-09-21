<?php

namespace Redius\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Redius\Contracts\ResourceInterface;
use Redius\Redius;
use Redius\Scope;

class ListScopes
{
    use BuildResourceResponse;

    public function __invoke(Request $request, ResourceInterface $resource): JsonResponse
    {
        $scopes = Redius::scopes($resource)->map(function (Scope $scope) {
            return [
                'id' => $scope->id(),
                'name' => $scope->name(),
            ];
        });

        return $this->buildCollectionResponse($scopes, null, 'scopes');
    }
}
