<?php

namespace Redius\Fields;

class Markdown extends Field
{
    protected string $component = 'markdown-field';

    public function isShowOnIndex(): bool
    {
        return false;
    }
}
