<?php

namespace Redius\Transformers;

use JetBrains\PhpStorm\ArrayShape;
use Redius\Contracts\FieldInterface;

class FieldTransformer extends Transformer
{
    #[ArrayShape(['id' => 'mixed'])]
    public function transform($field): array
    {
        /** @var FieldInterface $field */
        return ['id' => $field->getName(), ...$field->toArray()];
    }
}
