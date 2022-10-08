<?php

namespace Redius\Contracts;

use Illuminate\Database\Eloquent\Model;

interface GlobalActionInterface
{
    public function handleGlobal(ResourceInterface $resource, array $fields = []);
}