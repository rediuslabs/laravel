<?php

namespace Redius\Transformers;

use League\Fractal\TransformerAbstract;
use Redius\Contracts\TransformerInterface;

class Transformer extends TransformerAbstract implements TransformerInterface
{
    public function transform($data)
    {
        return $data;
    }
}