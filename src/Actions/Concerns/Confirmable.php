<?php

namespace Redius\Actions\Concerns;

trait Confirmable
{
    protected string $confirmText = 'Are you sure you want to do this?';

    public function confirm(string $text): self
    {
        return $this->confirmText($text);
    }

    public function confirmText(string $text): self
    {
        $this->confirmText = $text;

        return $this;
    }
}
