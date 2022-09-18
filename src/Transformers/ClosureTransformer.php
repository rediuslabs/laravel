<?php

namespace Redius\Transformers;

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
