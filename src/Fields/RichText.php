<?php

namespace Redius\Fields;

use Redius\Component;
use Redius\Contracts\ComponentInterface;

class RichText extends Field
{
    public function isShowOnIndex(): bool
    {
        return false;
    }

    public function component(): ComponentInterface
    {
        return new Component('editor-field');
    }
}
