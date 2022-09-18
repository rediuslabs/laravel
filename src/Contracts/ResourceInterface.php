<?php

namespace Redius\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface ResourceInterface
{
    public function name(): string;

    public function label(): string;

    public function icon(): ?string;

    public function model(): string;

    public function fields(): array;

    public function actions(): array;

    public function filters(): array;

    public function middlewares(): array;

    public function authorize(): bool;

    public function transformer(): TransformerInterface;
}
