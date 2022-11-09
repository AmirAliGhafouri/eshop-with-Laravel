<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class userAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {       

        if(!Session::has('user') and $request->is("addtocart/*"))
        return redirect('/login');

        if(!Session::has('user') and $request->path()!="/" and $request->path()!="login" and $request->path()!="sign-in" and $request->path()!="search" and !$request->is("products/*") and !$request->is("details/*")){
            return redirect('/');
        }

        if(Session::has('user')){
            if(!Session::get('user')['admin'] and ($request->path()=="admin-panel" or $request->path()=="add-product" or $request->is("remove-product/*") or $request->is("edit-product/*") or $request->is("edit/*") or $request->path()=="add-admin"))
                return redirect('/');
        }


        return $next($request);
    }
}
