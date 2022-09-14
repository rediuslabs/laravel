<?php

namespace Redius\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Redius\Contracts\ResourceInterface;
use Redius\Transformers\FieldTransformer;

class ListFields
{
    use BuildResourceResponse;

    public function __invoke(Request $request, ResourceInterface $resource): JsonResponse
    {
        return $this->buildCollectionResponse($resource->fields(), new FieldTransformer, 'fields');
    }
}
