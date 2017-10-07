<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\UserMeta;
use Request;

class UserOnline
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $user = $request->user();
        if ($user!=false && !is_null($user)){
            UserMeta::user($user)->where('meta_name','=','last_login')->update(['meta_value'=>strtotime("now")]);
            UserMeta::user($user)->where('meta_name','=','last_login_ip')->update(['meta_value'=>Request::ip()]);
        }

        return $next($request);
    }
}
