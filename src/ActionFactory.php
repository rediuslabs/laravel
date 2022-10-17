<?php

namespace Redius;

use Redius\Actions\BulkAction;
use Redius\Actions\GlobalAction;
use Redius\Actions\SingleAction;
use Redius\Exceptions\InvalidArgumentException;

class ActionFactory
{
    /**
     * @throws InvalidArgumentException
     */
    public static function make(?string $label, \Closure|string $handler = null): BulkAction
    {
        return new BulkAction($label, $handler ?? fn () => null);
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function bulk(?string $label, \Closure|string $handler = null): BulkAction
    {
        return new BulkAction($label, $handler ?? fn () => null);
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function global(?string $label, \Closure|string $handler = null): GlobalAction
    {
        return new GlobalAction($label, $handler ?? fn () => null);
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function single(?string $label, \Closure|string $handler = null): SingleAction
    {
        return new SingleAction($label, $handler ?? fn () => null);
    }
}
