<?php

namespace Redius\Controllers;

use Redius\Redius;

trait BuildResourceResponse
{
    /**
     * Create the response for an item.
     *
     * @param  mixed  $item
     * @param  \League\Fractal\TransformerAbstract  $transformer
     * @param  int  $status
     * @param  array  $headers
     * @return Response
     */
    protected function buildItemResponse($item, \League\Fractal\TransformerAbstract $transformer, $status = 200, array $headers = [])
    {
        $resource = new \League\Fractal\Resource\Item($item, $transformer);

        return $this->buildResourceResponse($resource, $status, $headers);
    }

    /**
     * Create the response for a collection.
     *
     * @param  mixed  $collection
     * @param  \League\Fractal\TransformerAbstract  $transformer
     * @param  int  $status
     * @param  array  $headers
     * @return Response
     */
    protected function buildCollectionResponse($collection, \League\Fractal\TransformerAbstract $transformer, ?string $resouceKey = null, $status = 200, array $headers = [])
    {
        $resource = new \League\Fractal\Resource\Collection($collection, $transformer, $resouceKey);

        return $this->buildResourceResponse($resource, $status, $headers);
    }

    /**
     * Create the response for a resource.
     *
     * @param  \League\Fractal\Resource\ResourceAbstract  $resource
     * @param  int  $status
     * @param  array  $headers
     * @return Response
     */
    protected function buildResourceResponse(\League\Fractal\Resource\ResourceAbstract $resource, $status = 200, array $headers = [])
    {
        $fractal = Redius::responseManager();

        return response()->json(
            $fractal->createData($resource)->toArray(),
            $status,
            $headers
        );
    }
}
