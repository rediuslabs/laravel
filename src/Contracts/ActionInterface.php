<?php

namespace Redius\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Redius\Requests\ActionRequest;

interface ActionInterface extends Arrayable, Jsonable
{
    public function id(): int|string;

    public function label(?string $label = null): static|string;

    public function methods(?array $methods = []): static|array;

    public function middlewares(?array $middlewares = []): static|array;

    public function handle(ResourceInterface $resource, ActionRequest $request);
}
