<?php

namespace Redius\Fields;

class RichText extends Field
{
    protected string $component = 'editor-field';

    public function isShowOnIndex(): bool
    {
        return false;
    }
}
