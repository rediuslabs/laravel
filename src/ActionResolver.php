<?php

namespace Redius;

use Redius\Contracts\ActionInterface;
use Redius\Exceptions\InvalidArgumentException;

class ActionResolver
{
    public static function normalize(array $actions): \Illuminate\Support\Collection
    {
        return collect($actions)->map(function ($action, $key) {
            if (is_string($action) && \is_subclass_of($action, ActionInterface::class)) {
                $action = new $action(\is_string($key) ? $key : null);
            }

            if (is_string($action) && class_exists($action)) {
                $action = ActionFactory::bulk(\is_string($key) ? $key : $action, $action);
            }

            // 'actionName' => fn() => 'result'
            if (\is_string($key) && $action instanceof \Closure) {
                $action = ActionFactory::bulk($key, $action);
            }

            // [Action::class, 'actionName'] or ['actionName', Action::class]
            if (is_array($action) && count($action) === 2) {
                if (is_string($action[0])) {
                    [$action, $label] = $action;
                } else {
                    [$label, $action] = $action;
                }

                $action = ActionFactory::bulk($label, $action);
            }

            if (! $action instanceof ActionInterface) {
                throw new InvalidArgumentException('Invalid action found');
            }

            return $action;
        });
    }
}
