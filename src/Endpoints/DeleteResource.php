<?php

namespace Redius\Endpoints;

class DeleteResource
{
    public function __invoke(): \Illuminate\Http\Response
    {
        return \response()->noContent();
    }
}
