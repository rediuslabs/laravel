<?php

namespace Redius\Controllers;

use Illuminate\Http\Request;

class ListFields
{
    public function __invoke(Request $request, string $model)
    {
        return [[
            'id' => [
                'type' => 'number',
                'label' => 'ID',
                'sortable' => true,
                'searchable' => true,
            ],
        ]];
    }
}
