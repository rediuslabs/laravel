<?php

namespace Redius\Fields;

class Avatar extends Field
{
    public function rounded()
    {
        $this->componentAttributes['type'] = 'rounded';
    }

    public function roundedFull()
    {
        $this->componentAttributes['type'] = 'rounded-full';
    }
}
