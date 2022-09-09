<?php

namespace Redius\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

interface FieldInterface extends Arrayable, Jsonable
{
    public function name(): string;

    public function label(): string;

    public function isSortable(): bool;

    public function isSearchable(): bool;

    public function isFilterable(): bool;

    public function isRequired(): bool;

    public function isReadonly(): bool;

    public function isHidden(): bool;

    public function isShowOnIndex(): bool;

    public function isShowOnDetail(): bool;

    public function isShowOnCreation(): bool;

    public function isShowOnUpdate(): bool;

    public function component(): ComponentInterface;
}
