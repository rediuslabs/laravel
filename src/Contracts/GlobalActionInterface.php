<?php

namespace Redius\Contracts;

interface GlobalActionInterface
{
    public function handleGlobal(ResourceInterface $resource, array $fields = []);
}
