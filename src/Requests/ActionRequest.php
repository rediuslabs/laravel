<?php

namespace Redius\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'action' => 'required|string',
            'ids' => 'required|array',
            'ids.*' => 'required',
            'fields' => 'nullable|array',
        ];
    }
}