<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            $uri = $request->path();

            // URIが以下から始まる場合
            if(Str::startsWith($uri, ['diyers/', 'mentors/'])) {

                return 'multi_login';

            }

            return route('login');
        }
    }
}
