<?php

namespace Redius\Actions\Concerns;

trait HasIcon
{
    protected ?string $icon = null;

    public function icon(?string $icon): static|string|null
    {
        if ($icon === null) {
            return $this->icon;
        }

        $this->icon = $icon;

        return $this;
    }
}
