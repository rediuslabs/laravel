<?php

namespace Redius\Actions\Concerns;

trait HasMiddlewares
{
    protected array $middlewares = [];

    public function middleware(string $middleware): self
    {
        return $this->middlewares([$middleware]);
    }

    public function middlewares(?array $middlewares = []): static|array
    {
        if (empty($middlewares)) {
            return $this->middlewares;
        }

        $this->middlewares = $middlewares;

        return $this;
    }
}
