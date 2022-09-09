<?php

namespace Redius\Fields;

class Avatar extends Field
{
    public function rounded()
    {
        $this->attributes['type'] = 'rounded';
    }

    public function roundedFull()
    {
        $this->attributes['type'] = 'rounded-full';
    }
}
