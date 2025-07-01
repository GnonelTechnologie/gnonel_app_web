<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;

class SpecificationAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $verif = User::verifabonnement($user);

        // Si l'utilisateur n'a pas d'abonnement ou que l'abonnement est expiré
        if ($verif == null || $verif->date_fin < date('Y-m-d')) {
            // Seuls les utilisateurs type_user == 3 (non-abonnés) peuvent accéder aux spécifications admin
            if ($user->type_user == 3) {
                // Autoriser l'accès mais filtrer les spécifications côté contrôleur
                return $next($request);
            } else {
                // Rediriger vers la page d'abonnement pour les autres types d'utilisateurs
                session()->flash('message', 'Veuillez vous abonner pour accéder aux spécifications techniques.');
                return redirect()->route('pricing');
            }
        }

        // Utilisateurs abonnés : accès autorisé
        return $next($request);
    }
} 