<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use App\Mail\TeamInvitationMail;
use App\Mail\TeamNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Afficher la liste des équipes de l'utilisateur
     */
    public function index()
    {
        $user = Auth::user();
        $teams = Team::getUserTeams($user->id);
        
        return view('teams.index', compact('teams'));
    }

    /**
     * Afficher le formulaire de création d'équipe
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Créer une nouvelle équipe
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'team_name' => 'required|string|max:255',
            'member_email' => 'required|email',
            'role' => 'required|in:member,admin'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $memberEmail = $request->member_email;

        // Vérifier si l'utilisateur existe déjà
        $existingUser = User::where('email', $memberEmail)->first();

        if ($existingUser) {
            // L'utilisateur existe déjà, créer l'équipe et envoyer une notification
            $team = Team::create([
                'user_id' => $user->id,
                'member_id' => $existingUser->id,
                'team_name' => $request->team_name,
                'role' => $request->role,
                'status' => 'active'
            ]);

            // Envoyer un email de notification
            Mail::to($memberEmail)->send(new TeamNotificationMail($team, $user));

            return redirect()->route('teams.index')
                           ->with('success', 'Membre ajouté à l\'équipe avec succès. Un email de notification a été envoyé.');
        } else {
            // L'utilisateur n'existe pas, créer un compte temporaire
            $tempUser = User::create([
                'name' => 'Utilisateur temporaire',
                'email' => $memberEmail,
                'password' => Hash::make(Str::random(16)),
                'email_verified_at' => null,
                'type_user' => 3, // Type par défaut
                'is_temp_user' => true // Marquer comme utilisateur temporaire
            ]);

            $team = Team::create([
                'user_id' => $user->id,
                'member_id' => $tempUser->id,
                'team_name' => $request->team_name,
                'role' => $request->role,
                'status' => 'active'
            ]);

            // Envoyer un email d'invitation avec lien de configuration
            Mail::to($memberEmail)->send(new TeamInvitationMail($team, $user));

            return redirect()->route('teams.index')
                           ->with('success', 'Invitation envoyée avec succès. L\'utilisateur recevra un email pour configurer son compte.');
        }
    }

    /**
     * Afficher les détails d'une équipe
     */
    public function show($id)
    {
        $team = Team::with(['owner', 'member'])->findOrFail($id);
        
        // Vérifier que l'utilisateur est membre de l'équipe
        if (!$team->isMember(Auth::id())) {
            return redirect()->route('teams.index')->with('error', 'Accès non autorisé.');
        }

        return view('teams.show', compact('team'));
    }

    /**
     * Changer d'équipe active (session)
     */
    public function switchTeam($id)
    {
        $team = Team::findOrFail($id);
        
        // Vérifier que l'utilisateur est membre de l'équipe
        if (!$team->isMember(Auth::id())) {
            return redirect()->route('teams.index')->with('error', 'Accès non autorisé.');
        }

        // Stocker l'équipe active en session
        session(['active_team_id' => $id]);
        session(['active_team_name' => $team->team_name]);

        return redirect()->back()->with('success', 'Équipe changée avec succès.');
    }

    /**
     * Retourner à l'espace personnel
     */
    public function switchToPersonal()
    {
        session()->forget(['active_team_id', 'active_team_name']);

        return redirect()->route('home')->with('success', 'Retour à l\'espace personnel.');
    }

    /**
     * Supprimer un membre de l'équipe
     */
    public function removeMember($id)
    {
        $team = Team::findOrFail($id);
        
        // Vérifier que l'utilisateur est propriétaire de l'équipe
        if (!$team->isOwner(Auth::id())) {
            return redirect()->route('teams.index')->with('error', 'Accès non autorisé.');
        }

        $team->update(['status' => 'inactive']);

        return redirect()->route('teams.index')->with('success', 'Membre supprimé de l\'équipe.');
    }

    /**
     * Configuration du compte pour utilisateur temporaire
     */
    public function configureAccount($token)
    {
        // Décoder le token pour obtenir l'email
        $email = base64_decode($token);
        $user = User::where('email', $email)->where('is_temp_user', true)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Lien d\'invitation invalide ou expiré.');
        }

        return view('teams.configure-account', compact('user', 'token'));
    }

    /**
     * Sauvegarder la configuration du compte
     */
    public function saveAccountConfiguration(Request $request, $token)
    {
        $email = base64_decode($token);
        $user = User::where('email', $email)->where('is_temp_user', true)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Lien d\'invitation invalide ou expiré.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mettre à jour les informations utilisateur
        $user->update([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
            'is_temp_user' => false,
            'email_verified_at' => now()
        ]);

        // Connecter automatiquement l'utilisateur
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Compte configuré avec succès. Vous êtes maintenant connecté.');
    }

    /**
     * Obtenir les équipes d'un utilisateur (API)
     */
    public function getUserTeams()
    {
        $user = Auth::user();
        $teams = Team::getUserTeams($user->id);
        
        return response()->json($teams);
    }

    /**
     * Obtenir l'équipe active (API)
     */
    public function getActiveTeam()
    {
        $activeTeamId = session('active_team_id');
        
        if ($activeTeamId) {
            $team = Team::with(['owner', 'member'])->find($activeTeamId);
            return response()->json($team);
        }
        
        return response()->json(null);
    }
} 