<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        /*
         * 1. Si el usuario eligió manualmente un idioma,
         *    respetamos esa selección.
         */
        if (session()->has('locale')) {
            $locale = session('locale');
        } else {
            /*
             * 2. Detectamos el idioma preferido del navegador.
             */
            $browserLocale = $request->getPreferredLanguage([
                'es',
                'en',
            ]);

            $locale = $browserLocale ?: config('app.fallback_locale', 'en');
        }

        /*
         * Seguridad:
         * solamente permitimos idiomas soportados.
         */
        if (! in_array($locale, ['es', 'en'], true)) {
            $locale = config('app.fallback_locale', 'en');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
