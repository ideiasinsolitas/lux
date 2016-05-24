<?php namespace App\Http\Middleware;

use Closure;

/**
 * Class LocaleMiddleware
 * @package App\Http\Middleware
 */
class LocaleMiddleware
{

    /**
     * @var array
     */
    protected $languages = ['en', 'es', 'fr-FR', 'it', 'pt-BR', 'ru', 'sv'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
<<<<<<< HEAD
<<<<<<< HEAD
        if (session()->has('locale') && in_array(session()->get('locale'), $this->languages)) {
=======
        if(session()->has('locale') && in_array(session()->get('locale'), $this->languages))
        {
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
        if(session()->has('locale') && in_array(session()->get('locale'), $this->languages))
        {
=======
        if (session()->has('locale') && in_array(session()->get('locale'), $this->languages)) {
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
            app()->setLocale(session()->get('locale'));
        }

        return $next($request);
    }
}
