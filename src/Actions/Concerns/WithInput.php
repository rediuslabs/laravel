<?php

namespace Redius\Actions\Concerns;

trait WithInput
{
    protected array $fields = [];

    public function input(string $name, string $label, string $fieldType): self
    {
        return $this->field($name, $label, $fieldType);
    }

    public function field(string $name, string $label, string $fieldType): self|array
    {
        return $this->fields([\compact('name', 'label', 'fieldType')]);
    }

    public function fields(?array $fields = []): self|array
    {
        if (empty($fields)) {
            return $this->fields;
        }

        $this->fields = $fields;

        return $this;
    }
}
