<?php

namespace Redius\Transformers;

use League\Fractal\TransformerAbstract;
use Redius\Contracts\FieldInterface;

class FieldTransformer extends TransformerAbstract
{
    public function transform(FieldInterface $field)
    {
        return ['id' => $field->getName(), ...$field->toArray()];
    }
}
