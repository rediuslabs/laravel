<?php

namespace Redius\Adapters;

use Illuminate\Pagination\CursorPaginator;
use League\Fractal\Pagination\CursorInterface;

class IlluminateCursorPaginatorAdapter implements CursorInterface
{
    public function __construct(protected CursorPaginator $paginator)
    {
    }

    #[\ReturnTypeWillChange]
    public function getCurrent()
    {
        return $this->paginator->cursor();
    }

    #[\ReturnTypeWillChange]
    public function getPrev()
    {
        return $this->paginator->previousCursor();
    }

    #[\ReturnTypeWillChange]
    public function getNext()
    {
        return $this->paginator->nextCursor();
    }

    public function getCount(): ?int
    {
        return $this->paginator->count();
    }

    public function toArray()
    {
        return [
            'current' => $this->getCurrent(),
            'prev' => $this->getPrev(),
            'next' => $this->getNext(),
            'count' => $this->getCount(),
        ];
    }
}