<?php

namespace App\Http\Middleware;

use Closure;

class LoginCheck
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
        if (get_user_id()) {
            return $next($request);
        } else {
            // TODO 跳转到登录,登陆成功后返回到原来页面
            if ($request->ajax()) {
                return response("Unauthorized.(未登录)", 401)->header("X-CSRF-TOKEN", csrf_token());
            } else {
                return redirect('/login');
            }
        }
    }
}
