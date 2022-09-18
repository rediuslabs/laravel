<?php

namespace Redius\Transformers;

use JetBrains\PhpStorm\ArrayShape;

class FieldTransformer extends Transformer
{
    #[ArrayShape(['id' => 'mixed', 1 => 'mixed'])]
    public function transform($field): array
    {
        return ['id' => $field->getName(), ...$field->toArray()];
    }
}
