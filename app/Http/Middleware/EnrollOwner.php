<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use NoLimits\Championship\Enroll;

class EnrollOwner
{
    public function handle(Request $request, Closure $next)
    {
        $enroll = Enroll::firstOrFail($request->route('enrollId'));

        if ($enroll->user() != $request->user()) {
            return redirect()->home();
        }

        return $next($request);
    }
}
