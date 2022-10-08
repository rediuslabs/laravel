<?php

namespace Redius\Contracts;

use Illuminate\Database\Eloquent\Model;

interface SingleActionInterface
{
    public function handleSingle(ResourceInterface $resource, Model $model, array $fields = []);
}