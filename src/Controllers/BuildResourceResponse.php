<?php

namespace Redius\Controllers;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use League\Fractal\Pagination\IlluminatePaginatorAdapter as IlluminateLengthAwarePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceAbstract;
use League\Fractal\TransformerAbstract;
use Redius\Adapters\IlluminateCursorPaginatorAdapter;
use Redius\Adapters\IlluminatePaginatorAdapter;
use Redius\Redius;
use Redius\Transformers\Transformer;

trait BuildResourceResponse
{
    protected function buildItemResponse($item, ?TransformerAbstract $transformer = null, $status = 200, array $headers = []): JsonResponse
    {
        $transformer ??= new Transformer();

        $resource = new Item($item, $transformer);

        if ($item instanceof Model && $item->wasRecentlyCreated) {
            $status = 201;
        }

        return $this->buildResourceResponse($resource, $status, $headers);
    }

    protected function buildCollectionResponse($collection, ?TransformerAbstract $transformer = null, ?string $resourceKey = null, $status = 200, array $headers = []): JsonResponse
    {
        $transformer ??= new Transformer();

        if ($collection instanceof Paginator) {
            $resource = new Collection($collection->getCollection(), $transformer, $resourceKey);

            if ($collection instanceof LengthAwarePaginator) {
                $resource->setPaginator(new IlluminateLengthAwarePaginatorAdapter($collection));
            } else {
                $resource->setPaginator(new IlluminatePaginatorAdapter($collection));
            }
        } elseif ($collection instanceof CursorPaginator) {
            $resource = new Collection($collection->getCollection(), $transformer, $resourceKey);
            $resource->setCursor(new IlluminateCursorPaginatorAdapter($collection));
        } else {
            $resource = new Collection($collection, $transformer, $resourceKey);
        }

        return $this->buildResourceResponse($resource, $status, $headers);
    }

    protected function buildResourceResponse(ResourceAbstract $resource, $status = 200, array $headers = []): JsonResponse
    {
        $fractal = Redius::responseManager();

        $headers['content-type'] = 'application/vnd.api+json; charset=utf-8';

        return response()->json(
            $fractal->createData($resource)->toArray(),
            $status,
            $headers
        );
    }
}
