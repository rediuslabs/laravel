<?php

namespace Redius\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ActionInterface
{
    public function handle(ResourceInterface $resource, Model $model, array $fields = []);
}