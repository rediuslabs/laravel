<?php

namespace Redius\Contracts;

use Illuminate\Database\Eloquent\Scope;

interface ResourceInterface
{
    public function name(): string;

    public function label(): string;

    public function icon(): ?string;

    public function model(): string;

    public function fields(): array;

    public function actions(): array;

    public function filters(): array;

    public function scopes(): array;

    public function middlewares(): array;

    public function authorize(): bool;

    public function defaultScope(): ?Scope;

    public function transformer(): TransformerInterface;
}
