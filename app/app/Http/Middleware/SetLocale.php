<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        App::setLocale('ja'); // ← ロケールを日本語に強制設定
        return $next($request);
    }
}
