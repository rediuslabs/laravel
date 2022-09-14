<?php

namespace Redius\Transformers;

use League\Fractal\TransformerAbstract;

class FieldTransformer extends TransformerAbstract
{
    public function transform(ActionInterface $field)
    {
        return ['id' => $field->getName(), ...$field->toArray()];
    }
}
