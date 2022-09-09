<?php

namespace Redius\Fields;

use Redius\Component;
use Redius\Contracts\ComponentInterface;

class Markdown extends Field
{
    public function isShowOnIndex(): bool
    {
        return false;
    }

    public function component(): ComponentInterface
    {
        return new Component('markdown-field');
    }
}
