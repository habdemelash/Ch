<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SetLocale
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
        $languages = array_keys(config('app.languages'));
        $route = $request->route();
        if(Auth::check()){
            $user = User::find(Auth::user()->id);

        }
       

        if (request('change_language')) {
            session()->put('language', request('change_language'));
            $language = request('change_language');
            if (array_key_exists('locale', $route->parameters) && $route->parameters['locale'] != $language)
            {
                $route->parameters['locale'] = $language;

                if (in_array($language, $languages)) {

                    app()->setLocale($language); 
                    if(Auth::check()){
                        $user->locale =$language;
                        $user->update();
                    }
                    
                }

                return redirect(route($route->getName(), $route->parameters));
            }
        } elseif (session('language')) {
            $language = session('language');

            if (array_key_exists('locale', $route->parameters) && $route->parameters['locale'] != $language && in_array($route->parameters['locale'], $languages))
            {
                $language = $route->parameters['locale'];
                session()->put('language', $language);
            }
        } elseif (config('app.locale')) {
            if(Auth::check())
            {
                 $language = DB::table('users')->where('id','=', Auth::user()->id)->value('locale');
            }
            else
            {
                $language = config('app.locale');
            }
            
        }

        if (isset($language) && in_array($language, $languages))
        {
            app()->setLocale($language);
             if(Auth::check()){
                        $user->locale =$language;
                        $user->update();
            }
        }

        return $next($request);
    }
}
