<?php

namespace Redius\Fields;

use Redius\Component;
use Redius\Contracts\ComponentInterface;

class Timestamp extends Field
{
    protected string $format = 'YYYY-MM-DD HH:mm:ss';

    public function format(string $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function component(): ComponentInterface
    {
        return new Component('timestamp-field', [
            'format' => $this->format,
        ]);
    }
}
