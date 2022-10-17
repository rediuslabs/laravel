<?php

namespace Redius\Actions\Concerns;

trait LimitedRequestMethods
{
    protected array $methods = ['POST'];

    public function method(string $method): self
    {
        return $this->methods([$method]);
    }

    public function methods(?array $methods = []): static|array
    {
        if (empty($methods)) {
            return $this->methods;
        }

        $this->methods = \array_map('strtoupper', $methods);

        return $this;
    }
}
