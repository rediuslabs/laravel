<?php

namespace Redius\Fields;

use Redius\Component;
use Redius\Contracts\ComponentInterface;

class Url extends Field
{
    public function component(): ComponentInterface
    {
        return new Component('url-field');
    }
}
