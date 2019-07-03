<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Store;

class VendorOnlyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guest()) return redirect(URL::to('/'));
        
        $user_has_access = Store::where('owneremail',Auth::user()->email)->get()->first();
        if(!$user_has_access) redirect(URL::to('/'));

        return $next($request);
    }
}
