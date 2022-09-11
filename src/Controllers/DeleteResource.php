<?php

namespace Redius\Controllers;

class DeleteResource
{
    public function __invoke(): \Illuminate\Http\Response
    {
        return \response()->noContent();
    }
}
