<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\profile;
use Illuminate\Support\Facades\Auth;

class Profiles
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

        if(Auth::guard()->check()){
            $id = self::ValidateProfile();

            if($id){
                return redirect('home/profile');
            }

        }
        
        return $next($request);   
    }

    public function ValidateProfile(){
        $id = Auth::user()->id;
        
        $id_profile=profile::where("id_user","=",$id)->get();
        
        if( $id_profile->isEmpty() ){
            return true;
        }
        return false;
    }
}
