<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        // dd(request()->user()==null);
        // if($request->ajax()==true){
        //     echo json_encode(['code'=>2,'font'=>'当前未登录']);
        // }else{
            if(request()->user()==null){
                return redirect('/home');
            }
            return $next($request);
        // }
        
    }
}
