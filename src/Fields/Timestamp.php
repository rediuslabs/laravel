<?php

namespace Redius\Fields;

class Timestamp extends Field
{
    protected string $format = 'YYYY-MM-DD HH:mm:ss';

    protected string $component = 'timestamp-field';

    protected array $componentAttributes = [
        'format' => 'YYYY-MM-DD HH:mm:ss',
    ];

    public function format(string $format): static
    {
        $this->format = $format;

        return $this;
    }
}
