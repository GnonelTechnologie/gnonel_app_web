<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Abonnement;
use App\User;
use App\Recommander;
use App\Categorieabonnement;
use App\CinetpayHelper;
use CinetPay\CinetPay;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class AbonnementController extends Controller
{


    public function index()
    {
        User::admin(Auth::user());
        $categories = Categorieabonnement::all();
        $abonnements = Abonnement::all();
        return view('abonnements/index', compact('abonnements', 'categories'));
    }

    public function store(Request $request)
    {
        User::admin(Auth::user());

        $validator = Validator::make(
            $request->all(),

            [

                'libelle' =>  'required',
                'description' =>  'required',
                'prix' => 'required',

            ]
        );



        if ($validator->fails()) {

            return redirect(route('abonnements.index'))->withErrors($validator->errors());
        } else {

            $abonnement = new Abonnement;
            $abonnement->libelle = $request->libelle;
            $abonnement->description = $request->description;
            $abonnement->monnaie = $request->monnaie;
            $abonnement->prix = $request->prix;
            $abonnement->categorie = $request->categorie;
            $abonnement->nbjours = $request->jours;
            $abonnement->prix_exo = $request->prix_exo;
            $abonnement->choixaut = $request->choixaut;
            $abonnement->choixop = $request->choixop;

            $abonnement->save();
            return redirect()->route('abonnements.index')->with('add_ok', '');
        }
    }

    public function edit($id)
    {
        User::admin(Auth::user());
        $categories = Categorieabonnement::all();
        $abonnements = Abonnement::all();
        $abonnement = Abonnement::find($id);
        return view('abonnements/index', compact('abonnement', 'abonnements', 'categories'));
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),

            [

                'libelle' =>  'required',
                'description' =>  'required',
                'prix' => 'required',

            ]
        );



        if ($validator->fails()) {

            return redirect(route('abonnements.index'))->withErrors($validator->errors());
        } else {
            $abonnement = Abonnement::find($id);
            $abonnement->libelle = $request->libelle;
            $abonnement->description = $request->description;
            $abonnement->monnaie = $request->monnaie;
            $abonnement->prix = $request->prix;
            $abonnement->categorie = $request->categorie;
            $abonnement->nbjours = $request->jours;
            $abonnement->prix_exo = $request->prix_exo;
            $abonnement->choixaut = $request->choixaut;
            $abonnement->choixop = $request->choixop;
            $abonnement->save();
            return redirect()->route('abonnements.index')->with('update_ok', '');
        }
    }

    public function delete($id)
    {
        User::admin(Auth::user());
        $abonnement = Abonnement::find($id);
        $abonnement->delete();
        return redirect()->route('abonnements.index')->with('delete_ok', '');
    }

    public function ajaxbonnement($libelle)
    {
        $abonnement = Abonnement::where('id', $libelle)->first();
        return response()->json($abonnement);
    }


    public function index_choix_abonement()
    {

        dd('ok choix');

        $pays = DB::table('pays')->orderby('nom_pays')->get();

        $abonnements = DB::table('abonnement')->get();

        dd($abonnements);

        return view('views_choix_abonnement', compact('pays', 'abonnements'));
    }



    public function choix_souscription()
    {

        $data = request()->validate([
            'soumissionnaires' => ['max:30'],
        ]);


        dd($data['soumissionnaires']);

        return view('view_creer_abonne', compact('offre', 'pays'));
    }

    public function valider_souscription($souscription)
    {
        $souscriptions = DB::table('souscriptions')->where('idsouscription', '=', $souscription)
            ->join('abonnement', 'abonnement.id', '=', 'souscriptions.idabonnement')
            ->get();
        session_start();
        $_SESSION["souscription"] = $souscription;


        $description_du_paiement = $souscriptions[0]->libelle; // Description du Payment
        $montant_a_payer = $souscriptions[0]->montant_finale_apaye;
        $return_url = "/return-subscription"; // Lien de retour CallBack CinetPay
        $cancel_url = "/cancel-subscription"; // Lien d'annulation CinetPay
        $id_transaction = $souscriptions[0]->idsouscription . '_' . date("YmdHis") . '' . $souscriptions[0]->iduser; // Identifiant du Paiement

        $response =  CinetpayHelper::generatePaymentLink(
            $id_transaction,
            $montant_a_payer,
            $description_du_paiement,
            $return_url,
            $cancel_url,
            auth()->user()
        );
        $lines = explode("\n", $response);
        $jsonResponse = '';

        foreach ($lines as $line) {
            if (trim($line) !== '' && strpos($line, '{') === 0) {
                // Trouver la ligne qui commence par '{' (début du JSON)
                $jsonResponse = $line;
                break;
            }
        }

        // Log de la réponse JSON
        Log::info("JSON response: " . $jsonResponse);

        // Décoder la réponse JSON
        $responseData = json_decode($jsonResponse, true);

        if (is_array($responseData) && isset($responseData['data']) && isset($responseData['data']['payment_url'])) {
            // Récupérer l'URL de paiement
            $paymentUrl = $responseData['data']['payment_url'];
            Log::info('Redirection soutchée');

            // Rediriger l'utilisateur vers l'URL de paiement
            return redirect()->away($paymentUrl);
        } else {
            Log::info('Echec de redirection');
            // Gérer les erreurs si l'URL de paiement n'est pas présente dans la réponse
            return redirect()->back();
        }
    }


    function getRamdomText($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }


    public function notify_url(Request $request)
    {
        $id_transaction = $_POST['cpm_trans_id'];
        Log::info("CinetPay notify: " . $id_transaction);

        if (!empty($id_transaction)) {
            try {
                $response =  CinetpayHelper::checkTransaction($id_transaction)->getData(true);

                // On verifie que le paiement est valide
                if ($response['code'] == '00') {
                    Log::info("Paiement valide");
                    $souscription = explode("_", $id_transaction)[0];
                    $paymentData = $response['data'];

                    $sous = DB::table('souscriptions')->where('idsouscription', '=', $souscription)
                        ->join('abonnement', 'abonnement.id', '=', 'souscriptions.idabonnement')->first();


                    $user = DB::table('users')->where('id', '=', $sous->iduser)->first();
                    if ($sous->montant_finale_apaye == $paymentData["amount"]) {
                        Log::info("Paiement complet");
                        $date = Carbon::now();
                        $date->addDays($sous->nbjours);
                        DB::table('souscriptions')->where('idsouscription', $souscription)->update([
                            'referencepaiement' => $id_transaction,
                            'statut' => 1,
                            'identifier' => generateRandomInteger(),
                            'amount' => $paymentData["amount"],
                            'payment_method' => $paymentData["payment_method"],
                            'status_p' => $paymentData["status"],
                            'date_fin' => Carbon::parse($date)->format('Y-m-d'),
                            'payment_reference' => $id_transaction
                        ]);

                        if ($user->ratache_autorite != null) {
                            $update = DB::table('users')
                                ->where('id', $user->id)
                                ->update(['type_user' => 5]);
                        } elseif ($user->ratache_operateur != null) {
                            $update = DB::table('users')
                                ->where('id', $user->id)
                                ->update(['type_user' => 4]);
                        }
                    }

                    die();
                } else {
                    Log::info("Paiement echoue");
                    echo 'Echec, votre paiement a échoué pour cause : ' . $response['message'];
                    die();
                }
            } catch (Exception $e) {
                // Une erreur s'est produite
                echo "Erreur :" . $e->getMessage();
            }
        } else {
            // redirection vers la page d'accueil
            die();
        }
    }

    public function return_url()
    {
        # code...
    }

    public function cancel_url()
    {
        # code...
    }



    public function creer_abonne($offre)
    {
        if (Auth()->check()) {
            $verif = User::verifabonnement(Auth::user());
            $ab = DB::table('abonnement')->where('libelle', $offre)->first();
            $addto = DB::table('souscriptions')->insert([
                'idabonnement' => $ab->id,
                'paysreference' => $verif->paysreference,
                'iduser' => Auth::user()->id,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
            return redirect(route('home'));
        }
        $pays = DB::table('pays')->orderby('nom_pays')->get();
        $abonnements = DB::table('abonnement')->get();
        $secteur_activites = DB::table('secteuractivite')->get();

        return view('landing.subscription', compact('offre', 'pays', 'abonnements', 'secteur_activites'));
    }



    public function souscription()
    {
        $bonus = 0;
        $data = request()->validate([
            'abonnement' => ['numeric', 'gt:0'],
            'name' => ['required', 'string', 'max:100'],
            'prename' => ['required', 'string', 'max:100'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'pays' => ['required'],
            'telephone' => ['required'],
            'type' => ['required'],
            'count' => ['required'],
            'structure' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        $abn = DB::table('abonnement')->where('id', '=', $data['abonnement'])->first()->prix;
        $remise = DB::table('configurations')->first()->bonus;
        $tva = DB::table('configurations')->first()->tva;
        $recom = null;
        $discountPack = 0;
        $discountRecom = 0;

        if (session("affiliation") != null) {
            $recom = Recommander::where('code', session("affiliation"))->first();
            if ($recom != null) {
                if ($recom->utilise == 0) {
                    $bonus = ($abn * $remise) / 100;
                }
            }
        }
        $discountRecom = $bonus * $data['count'];


        if ($data['count'] > 5) {
            $bonus += ($abn * 5) / 100;
            $discountPack = (($abn * 5) / 100) * $data['count'];
        }
        //dd($data);

        if ($data['type'] == "operateur") {

            $add = DB::table('users')->insert([
                'name' => $data['name'],
                'prenom' => $data['prename'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'role' => 'user',
                'type_user' => 55,
                'ratache_operateur' => $data['structure'],
                'password' => Hash::make($data['password']),
                'created_at' => NOW(),
                'updated_at' => NOW(),
                'status' => 0
            ]);
        } elseif ($data['type'] == "autorite") {

            $add = DB::table('users')->insert([
                'name' => $data['name'],
                'prenom' => $data['prename'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'role' => 'user',
                'type_user' => 55,
                'ratache_autorite' => $data['structure'],
                'password' => Hash::make($data['password']),
                'created_at' => NOW(),
                'updated_at' => NOW(),
                'status' => 0
            ]);
        } else {

            dd("Aucun type");
        }

        if ($add) {


            $user = DB::table('users')->where('email', '=', $data['email'])->get();

            if ($user[0]->id) {

                $addto = DB::table('souscriptions')->insertGetId([
                    'idabonnement' => $data['abonnement'],
                    'paysreference' => $data['pays'],
                    'count' => $data['count'],
                    'iduser' => $user[0]->id,
                    'montant_finale_apaye' => ($abn - $bonus) * $data['count'],
                    'frais_bonus' => $bonus * $data['count'],
                    'discount_pack' => $discountPack,
                    'discount_recom' => $discountRecom,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]);
                if ($recom != null) {
                    $recom->utilise = 1;
                    $recom->souscription_id = $addto;
                    $recom->save();
                }
                $souscriptions = DB::table('souscriptions')->get();
                $user = array('email' => $data['email'], 'password' => $data['password']);
                Auth::attempt($user);
                return redirect(route('home'));
            } else {

                dd('Une erreur c\'est produite lors de votre enrégistrement');
            }
        } else {

            dd('Echec d\'enrégistrement ...');
        }


        // if ($add) {


        //     $user = DB::table('users')->where('email','=',$data['email'])->get();

        //     $addto = DB::table('souscriptions')->insert([
        //         'idabonnement' => $data['abonnement'],
        //         'paysreference' => $data['pays'],
        //         'iduser' => $user[0]->id,
        //         'created_at' => NOW(),
        //         'updated_at' => NOW(),
        //     ]);

        //     return redirect(route('create_bon'));


        //     $souscriptions = DB::table('souscriptions')->where('idabonnement','=',$data['abonnement'])->where('iduser','=',$user[0]->id)->get();

        //     $prix = DB::table('abonnement')->where('id','=',$data['abonnement'])->get();
        //     $montant = $prix[0]->prix;
        //     $libelle = $prix[0]->libelle;
        //     $nom = $data['name'];
        //     $email = $data['email'];

        //     dd("https://paygateglobal.com/v1/page?token=cbc57ace-4574-489f-b7e3-665debe9ae25&amount=".$montant."&description=##S_".$souscriptions[0]->idsouscription."_U_".$user[0]->id."&identifier=".$souscriptions[0]->idsouscription);

        //     //$lien ="https://paygateglobal.com/v1/page?token=cbc57ace-4574-489f-b7e3-665debe9ae25&amount=".$montant."&description=Gnonel Souscription : ".$libelle.";".$nom." - ".$email." &identifier=10";

        //     //dd($lien);

        //     return redirect("https://paygateglobal.com/v1/page?token=cbc57ace-4574-489f-b7e3-665debe9ae25&amount=".$montant."&description=##S_".$souscriptions[0]->idsouscription."_U_".$user[0]->id."&identifier=".$souscriptions[0]->idsouscription);




        // $pays = DB::table('pays')->orderby('nom_pays')->get();
        // return view('views_choix_abonnement',compact('pays'));

    }
}
