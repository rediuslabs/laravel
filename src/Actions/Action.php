<?php

namespace Redius\Actions;

use Redius\Contracts\ActionInterface;
use Redius\Contracts\BulkActionInterface;
use Redius\Contracts\GlobalActionInterface;
use Redius\Contracts\ResourceInterface;
use Redius\Contracts\SingleActionInterface;
use Redius\Events\ActionExecuted;
use Redius\Exceptions\InvalidArgumentException;
use Redius\Requests\ActionRequest;

abstract class Action implements ActionInterface
{
    use Concerns\Confirmable;
    use Concerns\HasIcon;
    use Concerns\LimitedRequestMethods;
    use Concerns\HasMiddlewares;
    use Concerns\WithInput;

    protected ?string $icon = null;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(
        protected string $label,
        protected string|\Closure $handler,
        protected string|int|null $id = null
    ) {
        if (empty($this->label)) {
            throw new InvalidArgumentException('Action label is required.');
        }

        if ($this->handler instanceof self) {
            return $this->handler;
        }

        $this->id ??= \md5($this->label);
    }

    public function handle(ResourceInterface $resource, ActionRequest $request): array
    {
        $handler = \is_string($this->handler) ? app($this->handler) : $this->handler;

        return tap(\call_user_func($handler, $resource, $request), function ($result) use ($resource, $request) {
            \event(new ActionExecuted($this, $resource, $request, $result));
        });
    }

    public function id(): int|string
    {
        return $this->id;
    }

    public function label(?string $label = null): static|string
    {
        if (empty($label)) {
            return $this->label;
        }

        $this->label = $label;

        return $this;
    }

    public function handler(\Closure|string $handler): static
    {
        if (\is_string($handler)) {
            if (! \class_exists($handler)) {
                throw new InvalidArgumentException("Action class [{$handler}] does not exist.");
            }
        }

        $this->handler = $handler;

        return $this;
    }

    public function toJson($options = 0): bool|string
    {
        return \json_encode($this->toArray(), $options);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'icon' => $this->icon,
            'methods' => $this->methods,
            'middlewares' => $this->middlewares,
            'fields' => $this->fields,
            'is_bulk' => $this instanceof BulkActionInterface,
            'is_global' => $this instanceof GlobalActionInterface,
            'is_single' => $this instanceof SingleActionInterface,
        ];
    }
}
