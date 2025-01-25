<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controllers\Middleware;

class Test2Controller
{
    public static function middleware(): array
    {
        return [
            'group:admin',
            new Middleware('permission:Test2.__invoke'),
        ];
    }

    public function __invoke()
    {
        return 'Test 2';
    }
}
