<?php

namespace Redius\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

interface ComponentInterface extends Arrayable, Jsonable
{
    public function name(): string;

    public function attributes(): array;
}
