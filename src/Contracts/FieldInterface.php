<?php

namespace Redius\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

interface FieldInterface extends Arrayable, Jsonable, \JsonSerializable
{
    public function getName(): string;

    public function getLabel(): string;

    public function isSortable(): bool;

    public function isSearchable(): bool;

    public function isFilterable(): bool;

    public function isRequired(): bool;

    public function isReadonly(): bool;

    public function isShowOnIndex(): bool;

    public function isShowOnDetail(): bool;

    public function isShowOnCreation(): bool;

    public function isShowOnUpdate(): bool;

    public function getComponent(): ComponentInterface;
}
