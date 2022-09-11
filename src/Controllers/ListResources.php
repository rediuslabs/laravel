<?php

namespace Redius\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ListResources
{
    public function __invoke(Request $request, string $model)
    {
        $model = config('redius.model_namespace').Str::studly(Str::singular($model));

        return $model::all();
    }
}
