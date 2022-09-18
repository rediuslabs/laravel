<?php

namespace Redius\Adapters;

use Illuminate\Contracts\Pagination\Paginator;
use League\Fractal\Pagination\PaginatorInterface;

class IlluminatePaginatorAdapter implements PaginatorInterface
{
    public function __construct(protected Paginator $paginator)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrentPage(): int
    {
        return $this->paginator->currentPage();
    }

    /**
     * {@inheritDoc}
     */
    public function getLastPage(): int
    {
        return 1;
    }

    /**
     * {@inheritDoc}
     */
    public function getCount(): int
    {
        return $this->paginator->count();
    }

    /**
     * {@inheritDoc}
     */
    public function getPerPage(): int
    {
        return $this->paginator->perPage();
    }

    /**
     * {@inheritDoc}
     */
    public function getUrl(int $page): string
    {
        return $this->paginator->url($page);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'count' => $this->getCount(),
            'per_page' => $this->getPerPage(),
            'current_page' => $this->getCurrentPage(),
            'links' => [
                'previous' => $this->paginator->previousPageUrl(),
                'next' => $this->paginator->nextPageUrl(),
            ],
        ];
    }

    public function getTotal(): int
    {
        return 0;
    }
}
