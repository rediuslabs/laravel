<?php

namespace Redius\Transformers;

use League\Fractal\TransformerAbstract;
use Redius\Contracts\FieldInterface;
use Redius\Contracts\TransformerInterface;

class ClosureTransformer extends Transformer
{
    public function __construct(protected \Closure $callback)
    {
    }

    public static function make(\Closure $callback): static
    {
        return new static($callback);
    }

    public function transform($data)
    {
        return ($this->callback)($data);
    }
}
