<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // Récupérer l'utilisateur connecté

        $id = auth()->id();

        $user = DB::table('users')->where('id', $id)->limit(1)->get();


        // Rédiriger en fonction du role de l'utilisateur
        // Type User 0 administrateur, 1 opérateur, 2 autorité contractante, 3  abonnés, 4 user opérateur, 5 user autorité, 55 abonnéé en attente de validation
        // 55 utilisateurs s'étant enrégistré sans avoir effectué de paiement.
        if ($user[0]->type_user == 0) {
            $nbusers = DB::table('users')
                ->join('souscriptions', 'souscriptions.iduser', '=', 'users.id')
                ->where('type_user', '!=', 0)
                ->where('date_fin', '>', date('Y-m-d'))
                ->select('souscriptions.*', 'users.name', 'users.id', 'users.prenom', 'users.email')
                ->count();

            $nboffre = DB::table('appeloffres')->where('appeloffres.date_cloture', '>', date('Y-m-d H:i:s'))->count();
            $nboffrec = DB::table('appeloffres')->where('appeloffres.date_cloture', '<', date('Y-m-d H:i:s'))->count();
            $nbautorite = DB::table('autoritecontractantes')->count();

            $offres = DB::table('appeloffres')
                ->select('appeloffres.*')
                ->orderby('appeloffres.created_at', 'desc')
                ->limit(5)
                ->get();

            $months = array();
            $usersChart = array();
            /* STATS INSCRITS */
            $searchDatas = DB::table('users')
                ->where('type_user', '!=', 0)
                ->select(DB::raw('COUNT(users.id) AS count'), DB::raw('MONTH(users.created_at) AS monthnumber'))
                ->groupBy('monthnumber')
                ->orderBy('monthnumber')
                ->get();



            /* $searchDatas =  DB::table('appeloffres')
                ->select(DB::raw('COUNT(appeloffres.id) AS count'), DB::raw('MONTH(appeloffres.created_at) AS monthnumber'))
                ->groupBy('monthnumber')
                ->orderBy('monthnumber')
                ->get();*/


            foreach ($searchDatas as $item) {
                array_push($months, $item->monthnumber);
                array_push($usersChart, $item->count);
            }

            return view('dashboard', compact('offres', 'nbautorite', 'nboffrec', 'nboffre', 'nbusers', 'usersChart', 'months'));
        } else if ($user[0]->type_user == 3) {
            return redirect(url('/acceuil/membre'));
        } else if ($user[0]->type_user == 4) {
            //si l'utilisateur n'est pas rataché à un opérateur
            if ($user[0]->ratache_operateur == '') {

                dd('Utilisateur lié à aucun opérateur économique');
            } else {
                $verif = User::verifabonnement(Auth::user());

                if ($verif->date_fin == null) {
                    $souscriptions = DB::table('souscriptions')->where('iduser', '=', $verif->iduser)
                        ->join('abonnement', 'abonnement.id', '=', 'souscriptions.idabonnement')->select('souscriptions.idsouscription', 'souscriptions.montant_finale_apaye', 'souscriptions.discount_pack', 'souscriptions.discount_recom', 'abonnement.prix', 'abonnement.libelle', 'souscriptions.created_at', 'souscriptions.count', 'abonnement.monnaie', 'abonnement.nbjours', 'souscriptions.frais_bonus')
                        ->orderBy('souscriptions.idsouscription', 'DESC')
                        ->first();
                    return view('view_user_souscription', compact('souscriptions'));
                }

                // dd($verif);
                return redirect(url('/acceuil/membre'));
            }
        } else if ($user[0]->type_user == 5) {
            $verif = User::verifabonnement(Auth::user());

            if ($verif->date_fin == null) {
                $souscriptions = DB::table('souscriptions')->where('iduser', '=', $verif->iduser)
                    ->join('abonnement', 'abonnement.id', '=', 'souscriptions.idabonnement')->select('souscriptions.idsouscription', 'souscriptions.montant_finale_apaye', 'souscriptions.discount_pack', 'souscriptions.discount_recom', 'abonnement.prix', 'abonnement.libelle', 'souscriptions.created_at', 'souscriptions.count', 'abonnement.monnaie', 'souscriptions.frais_bonus', 'abonnement.nbjours')
                    ->orderBy('souscriptions.idsouscription', 'DESC')
                    ->first();
                return view('view_user_souscription', compact('souscriptions'));
            }

            return redirect(url('/acceuil/membre'));
        } else if ($user[0]->type_user == 55) {

            //Vérification de paiement et d'existance de souscription

            $souscriptions = DB::table('souscriptions')->where('iduser', '=', $id)
                ->join('abonnement', 'abonnement.id', '=', 'souscriptions.idabonnement')->select('souscriptions.idsouscription', 'souscriptions.montant_finale_apaye', 'souscriptions.discount_pack', 'souscriptions.discount_recom', 'abonnement.prix', 'abonnement.libelle', 'souscriptions.created_at', 'souscriptions.count', 'abonnement.monnaie', 'souscriptions.frais_bonus', 'abonnement.nbjours')
                ->orderBy('souscriptions.idsouscription', 'DESC')
                ->first();

            if ($souscriptions) {
                //souscription non vide
                $token = 'cbc57ace-4574-489f-b7e3-665debe9ae25';
                $identifier = $souscriptions->idsouscription;

                $reponse = Http::post('https://paygateglobal.com/api/v2/status', [
                    'auth_token' => $token,
                    'identifier' => $identifier,
                ]);

                //Si la reponse de l'api est reçu
                //Updater la souscription et activer l'utilisateur

                if ($reponse->json()) {

                    $paiement = $reponse->json();
                    //Vérifier si le status de paiement a été renvoyé par l'api

                    if (isset($paiement["status"])) {

                        //Vérifier le statut du paiement
                        //Repose 0 : Paiement réussi avec succès 2 : En cours 4 : Expiré 6: Annulé
                        //dd($paiement);
                        if ($paiement["status"] == 0) {
                            //Repose 0 : Paiement réussi, valider l'

                            dd("ok0");
                            $update_souscriptions = DB::table('souscriptions')
                                ->where('idsouscription', $identifier)
                                ->update([
                                    'tx_reference' => $paiement["tx_reference"],
                                    'identifier' => $paiement["identifier"],
                                    'amount' => $paiement['amount'],
                                    'payment_reference' => $paiement['payment_reference'],
                                    'payment_method' => $paiement['payment_method'],
                                    'datetime' => $paiement['datetime'],
                                    'status_p' => $paiement['status'],
                                    'statut' => 1
                                ]);

                            //Updater l'utilisateur, vérifier s'il sagit d'un operateur ou d'une autorité

                            //Continuer ici ...............................................

                        } elseif ($paiement["status"] == 2) {
                            //Repose 2 : En cours
                            dd("ok2");
                        } elseif ($paiement["status"] == 4) {
                            //Repose 4 : Expiré
                            dd("ok4");
                        } elseif ($paiement["status"] == 6) {
                            //Repose 6: Annulé
                            dd("ok6");
                        }
                    } else {

                        //le status n'existe pas
                        return view('view_user_souscription', compact('souscriptions'));
                    }
                } else {
                    dd("Aucun reçu de paiement");
                }
            } else {
                //souscription vide
                dd("Souscription non vide");
            }

            // utilisateur n'ayant pas solder l'abonnement 
            return view('view_user_souscription', compact('souscriptions'));
        }

        //Rédiriger en fonction du type user

    }

    function mySouscription(Request $request)
    {
        $souscription = User::verifabonnement(Auth::user());

        $teamUsers = User::where([
            'pack_user_id' => Auth::user()->id,
            'status' => 1
        ])->orWhere('id', Auth::user()->id)->get();

        return view('souscriptions/index', compact('souscription', 'teamUsers'));
    }


    function addUserSouscription(Request $request)
    {
        $data = request()->validate([
            'firstname' => ['required', 'max:100', 'string'],
            'lastname' => ['required', 'max:100', 'string'],
            'email' => ['required', 'max:100', 'string', 'unique:users'],
            'password' => ['required', 'max:100', 'string'],
            'confirm_password' => ['required', 'max:100', 'string', 'same:password'],
        ]);
        $authUser = Auth::user();

        User::create([
            'name' => $data['lastname'],
            'prenom' => $data['firstname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type_user' => $authUser->type_user,
            'actif' => $authUser->actif,
            'status' => 1,
            'role' => $authUser->role,
            'pays_id' => $authUser->pays_id,
            'pack_user_id' => $authUser->id,
            'ratache_operateur' => $authUser->ratache_operateur,
            'ratache_autorite' => $authUser->ratache_autorite
        ]);

        return redirect()->back()->with('flash_message_success', 'Personne ajoutée avec succès');
    }
    function deleteUserSouscription(Request $request, $idUser)
    {
        $user = User::find($idUser);
        $user->status = 0;
        $user->save();
        return redirect()->back()->with('flash_message_success', 'Personne retirée avec succès');
    }
}
