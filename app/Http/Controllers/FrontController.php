<?php

namespace App\Http\Controllers;

use App\Abonnement;
use App\Categorieabonnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Spec;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Request as FacadesRequest;

class FrontController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function viewmesref()
  {
    $verif = User::verifabonnement(Auth::user());


    $countRef = 0;
    $canPublish = true;

    $categories = DB::table('categories')->orderby('code_categorie', 'asc')->get();
    $categorieautorites = DB::table('categorieautorites')->orderby('id', 'asc')->get();
    $pays = DB::table('pays')->get();

    if ($verif == null && Auth::user()->type_user == 3) {
      $valide = DB::table('references')->where('status', '=', 1)->where('references.user_id', '=', Auth::user()->id)->count();
      $refuse = DB::table('references')->where('status', '=', 2)->where('references.user_id', '=', Auth::user()->id)->count();
      $att = DB::table('references')->where('status', '=', 0)->where('references.user_id', '=', Auth::user()->id)->count();

      $references = DB::table('references')
        ->where('references.user_id', '=', Auth::user()->id)
        ->orderby('references.created_at', 'desc')
        ->get();

      if ($references->count() >= 2) {
        $canPublish = false;
      }
    } else {
      if ($verif->date_fin == null) {
        return redirect(route('home'));
      } elseif ($verif->date_fin < date('Y-m-d')) {
        session()->flash('message', sprintf('Veuillez vous reabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
        return redirect(route('pricing'));
      }


      $valide = DB::table('references')->where('status', '=', 1)->where('references.operateur', '=', Auth::user()->ratache_operateur)->count();
      $refuse = DB::table('references')->where('status', '=', 2)->where('references.operateur', '=', Auth::user()->ratache_operateur)->count();
      $att = DB::table('references')->where('status', '=', 0)->where('references.operateur', '=', Auth::user()->ratache_operateur)->count();

      $references = DB::table('references')
        ->where('references.operateur', '=', Auth::user()->ratache_operateur)
        ->orderby('references.created_at', 'desc')
        ->get();
    }


    return view('index_user_operateur', compact('references', 'valide', 'pays', 'refuse', 'att', 'categories', 'categorieautorites', 'canPublish', 'verif'));
  }

  function editmesref($id)
  {

    $categories = DB::table('categories')->orderby('code_categorie', 'asc')->get();
    $categorieautorites = DB::table('categorieautorites')->orderby('id', 'asc')->get();
    $pays = DB::table('pays')->get();
    $reference = DB::table('references')
      ->where('references.operateur', '=', Auth::user()->ratache_operateur)
      ->where('references.idreference', '=', $id)
      ->orderby('references.created_at', 'desc')
      ->first();
    return view('edit_user_operateur', compact('reference', 'pays', 'categories', 'categorieautorites'));
  }

  function updatemesref($id, Request $request)
  {
    $data = request()->validate([
      'reference' => ['required', 'max:50'],
      'sous_traitance' => ['nullable'],
      'autorite' => ['required'],
      'annee_execution' => ['required'],
      'type' => ['required', 'numeric', 'gt:0'],
      'marche' => ['required', 'string'],
      'compte' => ['required', 'string'],
      'groupement' => ['required', 'string'],
      'montant' => ['nullable', 'numeric'],
      'date' => ['nullable'],
      'show_amount' => ['nullable', 'numeric'],
    ]);



    if ($request->file('preuve') == null) {
      $add = DB::table('references')
        ->where('idreference', $id)
        ->update([
          'date_contrat' => $data['date'],
          'reference_marche' => $data['reference'],
          'libelle_marche' => $data['marche'],
          'type_marche' => $data['type'],
          'montant' => $data['montant'],
          'show_amount' => $data['show_amount'],
          'annee_execution' => $data['annee_execution'],
          'autorite_contractante' => $data['autorite'],
          'sous_traitance' => $data['sous_traitance'],
          'compte' => $data['compte'],
          'groupement' => $data['groupement'],
          'status' => 0,
          'created_at' => NOW(),
          'updated_at' => NOW(),
        ]);
    } else {
      $add = DB::table('references')
        ->where('idreference', $id)
        ->update([
          'date_contrat' => $data['date'],
          'reference_marche' => $data['reference'],
          'libelle_marche' => $data['marche'],
          'type_marche' => $data['type'],
          'montant' => $data['montant'],
          'show_amount' => $data['show_amount'],
          'annee_execution' => $data['annee_execution'],
          'preuve_execution' => User::showUploadFile($request->file('preuve')),
          'autorite_contractante' => $data['autorite'],
          'sous_traitance' => $data['sous_traitance'],
          'compte' => $data['compte'],
          'groupement' => $data['groupement'],
          'status' => 0,
          'created_at' => NOW(),
          'updated_at' => NOW(),
        ]);
    }

    return redirect(route('viewmesref'))->with('update_ok', '');
  }
  function deletemesref($id)
  {
    $delete = DB::table('references')->where('idreference', '=', $id)->delete();
    if ($delete) {
      return redirect()->route('viewmesref')->with('delete_ok', '');
    }
    return redirect()->route('viewmesref');
  }



  // tous les reference pour l'autorité
  public function viewallref($id, Request $request)
  {
    $verif = User::verifabonnement(Auth::user());

    if ($verif->date_fin == null) {
      return redirect(route('home'));
    } elseif ($verif->date_fin < date('Y-m-d')) {
      session()->flash('message', sprintf('Veuillez vous reabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
      return redirect(route('pricing'));
    }
    $user = $id;
    //$valide=DB::table('references') ->where('status', '=', 1)->count();
    //$refuse=DB::table('references') ->where('status', '=', 2)->count();
    $att = DB::table('references')->where('status', '=', 0)->count();
    $references = DB::table('references')
      ->join('operateurs', 'operateurs.id', '=', 'references.operateur')
      ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
      ->join('autoritecontractantes', 'autoritecontractantes.id', '=', 'references.autorite_contractante')
      ->join('pays as p', 'p.id', '=', 'autoritecontractantes.id_pays')
      ->join('categories', 'categories.id', '=', 'references.type_marche')
      // ->join('users', 'users.ratache_operateur', '=', 'operateurs.id')
      ->where('references.operateur', '=', $user)
      ->where('references.status', '=', 1)
      ->when($request->gnonelid, function ($query, $gnonelid) {
        return $query->where('operateurs.gnonelid', 'LIKE', '%' . $gnonelid . '%');
      })
      ->select('references.*', 'autoritecontractantes.raison_social as autorite_contractante', 'nom_categorie', 'pays.nom_pays as paysau')
      ->orderby('references.created_at', 'desc')
      ->get();
    // return view('index_user_autorite',compact('references','valide','refuse','att'));

    return response()->json(
      [
        "status" => "success",
        "donnes" => $references

      ]
    );
  }

  public function enregoperateur()
  {
    $data = request()->validate([
      'nomop' => ['required'],
      'paysop' => ['required'],
      'numop' => ['nullable'],
      'mailop' => ['nullable'],
      'secteur' => ['nullable'],
      'autreop' => ['nullable'],
    ]);
    $indicatif = DB::table('pays')->where('id', $data['paysop'])->first()->indicatif;
    $lastid = DB::table('operateurs')->orderby('id', 'desc')->first()->id + 1;
    $gnonel = $indicatif . "2" . str_pad($lastid, 7, "0", STR_PAD_LEFT);
    $adduser = DB::table('operateurs')->insert([
      'raison_social' => $data['nomop'],
      'id_pays' => $data['paysop'],
      'des_operateur' => $data['autreop'],
      'num_fiscal' => $data['numop'],
      'gnonelid' => $gnonel,
      'mail' => $data['mailop'],
      'secteuractivite_id' => $data['secteur'],
      'created_at' => NOW(),
      'updated_at' => NOW(),

    ]);
    return redirect()->back()->with('flash_message_success', 'Enregistrement effectué avec succès. Vous le trouverez dans la liste des opérateurs');
  }
  public function enregautorite()
  {
    $data = request()->validate([
      'nomaut' => ['required'],
      'paysaut' => ['required'],
      'typeaut' => ['nullable'],
      'autreaut' => ['nullable'],
    ]);
    $indicatif = DB::table('pays')->where('id', $data['paysaut'])->first()->indicatif;
    $lastid = DB::table('autoritecontractantes')->orderby('id', 'desc')->first()->id + 1;
    $gnonel = $indicatif . "2" . str_pad($lastid, 7, "0", STR_PAD_LEFT);
    $adduser = DB::table('autoritecontractantes')->insert([
      'raison_social' => $data['nomaut'],
      'id_pays' => $data['paysaut'],
      'gnonelid' => $gnonel,
      'des_autorite' => $data['autreaut'],
      'categorieautorite_id' => $data['typeaut'],
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);
    return redirect()->back()->with('flash_message_success', 'Enregistrement effectué avec succès. Vous le trouverez dans la liste des autorités contractantes');
  }
  public function enregreference(Request $request)
  {
    $verif = User::verifabonnement(Auth::user());

    if ($verif == null && Auth::user()->type_user == 3) {
    } else {
      if ($verif->date_fin == null) {
        return redirect(route('home'));
      } elseif ($verif->date_fin < date('Y-m-d')) {
        session()->flash('message', sprintf('Veuillez vous reabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
        return redirect(route('pricing'));
      }
    }

    $data = request()->validate([
      'reference' => ['required'],
      'marche' => ['required'],
      'type' => ['nullable'],
      'annee_execution' => ['nullable'],
      'autorite' => ['required'],
      'sous_traitance' => ['nullable'],
      'compte' => ['nullable'],
      'groupement' => ['nullable'],
      'date' => ['nullable'],
      'montant' => ['nullable'],
      'show_amount' => ['nullable'],
    ]);



    if ($verif == null && Auth::user()->type_user == 3) {
      $add = DB::table('references')->insert([
        'reference_marche' => $data['reference'],
        'numeroreference' => User::genereId(),
        'libelle_marche' => $data['marche'],
        'type_marche' => $data['type'],
        'annee_execution' => $data['annee_execution'],
        'autorite_contractante' => $data['autorite'],
        'sous_traitance' => $data['sous_traitance'],
        'user_id' => Auth::user()->id,
        'compte' => $data['compte'],
        'operateur' => Auth::user()->ratache_operateur,
        'groupement' => $data['groupement'],
        'date_contrat' => $data['date'],
        'show_amount' => $data['show_amount'],
        'status' => 0,
        'created_at' => NOW(),
        'updated_at' => NOW(),
        'preuve_execution' => User::showUploadFile($request->file('preuve')),
        'montant' => $data['montant'],
      ]);
    } else {
      $add = DB::table('references')->insert([
        'reference_marche' => $data['reference'],
        'numeroreference' => User::genereId(),
        'libelle_marche' => $data['marche'],
        'type_marche' => $data['type'],
        'annee_execution' => $data['annee_execution'],
        'autorite_contractante' => $data['autorite'],
        'show_amount' => $data['show_amount'],
        'sous_traitance' => $data['sous_traitance'],
        'operateur' => Auth::user()->ratache_operateur,
        'compte' => $data['compte'],
        'groupement' => $data['groupement'],
        'date_contrat' => $data['date'],
        'status' => 0,
        'created_at' => NOW(),
        'updated_at' => NOW(),
        'preuve_execution' => User::showUploadFile($request->file('preuve')),
        'montant' => $data['montant'],
      ]);
    }

    return redirect()->back();
  }

  public function infocompte()
  {
    $verif = User::verifabonnement(Auth::user());

    if ($verif->date_fin == null) {
      return redirect(route('home'));
    } elseif ($verif->date_fin < date('Y-m-d')) {
      session()->flash('message', sprintf('Veuillez vous reabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
      return redirect(route('pricing'));
    }
    $operateur = DB::table('operateurs')
      ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
      ->leftjoin('secteuractivite', 'secteuractivite.idsecteuractivite', '=', 'operateurs.secteuractivite_id')
      ->select('operateurs.*', 'pays.nom_pays')
      ->where('operateurs.id', '=', Auth::user()->ratache_operateur)->first();
    return view('abonnes/infocompte', compact('operateur'));
  }

  public function infocompteaut()
  {
    $verif = User::verifabonnement(Auth::user());

    if ($verif->date_fin == null) {
      return redirect(route('home'));
    } elseif ($verif->date_fin < date('Y-m-d')) {
      session()->flash('message', sprintf('Veuillez vous reabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
      return redirect(route('pricing'));
    }
    $autorite = DB::table('autoritecontractantes')
      ->join('pays', 'pays.id', '=', 'autoritecontractantes.id_pays')
      ->select('autoritecontractantes.*', 'pays.nom_pays')
      ->where('autoritecontractantes.id', '=', Auth::user()->ratache_autorite)->first();
    // dd(Auth::user()->ratache_autorite);
    return view('abonnes/infocompteaut', compact('autorite'));
  }

  public function detailsreference($id)
  {
    $verif = User::verifabonnement(Auth::user());
    //dd($verif);
    $oper_id = DB::table('references')
      ->join('operateurs', 'operateurs.id', '=', 'references.operateur')
      ->where('references.idreference', $id)
      ->select('operateurs.id')
      ->first()->id;
    //dd($oper_id);
    $user_ref = User::where('ratache_operateur', $oper_id)->first();
    // ->join('users', 'users.ratache_operateur', '=', 'operateurs.id')

    if ($verif->date_fin == null) {
      return redirect(route('home'));
      dd(1);
    } elseif ($verif->date_fin < date('Y-m-d')) {
      dd(2);
      session()->flash('message', sprintf('Veuillez vous réabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
      return redirect(route('pricing'));
    }
    //dd($user_ref);
    if ($user_ref == null) {
      //dd(1);
      return back()->with('add_ok', '');
    }
    if ($user_ref->date_fin == null) {
      //dd(2);
      return back()->with('add_ok', '');
    } elseif ($user_ref->date_fin < date('Y-m-d')) {
      //dd(3);
      /*session()->flash('message', sprintf('Veuillez vous reabonner votre abonnement etait expiré le '.Carbon::parse($verif->date_fin)->format('d/m/Y')));
       return redirect(route('pricing'));*/
      return back()->with('add_ok', '');
    }

    $reference = DB::table('references')
      ->where('references.idreference', '=', $id)
      ->first();

    return view('detailsreference', compact('reference'));
  }
  public function selectoperateur(Request $request)
  {
    $verif = User::verifabonnement(Auth::user());

    $abon = \app\User::verifabonnement(\Illuminate\Support\Facades\Auth::user());
    $pays = null;
    $idpays = "";

    if (Auth::user()->ratache_operateur != null) {
      $idpays = DB::table('operateurs')->where('id', Auth::user()->ratache_operateur)->first()->id_pays;
    }
    if (Auth::user()->ratache_autorite != null) {
      $idpays = DB::table('autoritecontractantes')->where('id', Auth::user()->ratache_autorite)->first()->id_pays;
    }

    if ($verif->date_fin == null) {
      return redirect(route('home'));
    } elseif ($verif->date_fin < date('Y-m-d')) {
      return redirect(route('pricing'));
    }

    if ($abon->oper_local == 1 && $abon->oper_international == 1) {
      $pays = DB::table('pays')->get();
    } else {
      $pays = DB::table('pays')->where('id', $idpays)->get();
      //n'afficher que le pays que la personne qui s'est connecter
    }

    $paysId = isset($request->pays_id) ? $request->pays_id : 0;
    $operateurId = isset($request->operateur_id) ? $request->operateur_id : 0;


    return view('view_select_operateur', compact('pays', 'paysId', 'operateurId'));
  }

  public function service()
  {
    return view('landing.services');
  }
  public function service_business()
  {
    return view('landing.services.business');
  }
  public function service_pro()
  {
    return view('landing.services.pro');
  }
  public function service_mix()
  {
    return view('landing.services.mix');
  }
  public function service_options()
  {
    return view('landing.services.options');
  }

  public function contact()
  {
    return view('landing.contact');
  }

  public function pricing(FacadesRequest $request)
  {
    $pays = DB::table('pays')->orderby('nom_pays')->get();

    if (request('affiliation') != null) {
      session([
        'affiliation' => request('affiliation')
      ]);
    }
    $abonnements = Abonnement::all();
    $categories = Categorieabonnement::all();

    return view('landing.pricing', compact('pays', 'categories', 'abonnements'));
  }

  public function listspec()
  {
    $specs = Spec::where('status', 1)->paginate(12);
    $pays = DB::table('pays')->orderby('nom_pays')->get();
    $categories = DB::table('categories')->orderby('code_categorie', 'asc')->get();

    return view('spec', compact('specs', 'pays', 'categories'));
  }
  public function listspecabonne()
  {
    $verif = User::verifabonnement(Auth::user());

    $specs = Spec::where('specs.status', 1);

    if ($verif == null && Auth::user()->type_user == 3) {
      $specs =  $specs->join('users', 'users.id', '=', 'specs.user_id')->where('users.role', 'admin');
    } else {
      if ($verif->date_fin == null) {
        return redirect(route('home'));
      } elseif ($verif->date_fin < date('Y-m-d')) {
        session()->flash('message', sprintf('Veuillez vous reabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
        return redirect(route('pricing'));
      }
    }

    $specs = $specs->paginate(12);


    $idpays = "";
    if (Auth::user()->ratache_operateur != null) {
      $idpays = DB::table('operateurs')->where('id', Auth::user()->ratache_operateur)->first()->id_pays;
    }
    if (Auth::user()->ratache_autorite != null) {
      $idpays = DB::table('autoritecontractantes')->where('id', Auth::user()->ratache_autorite)->first()->id_pays;
    }
    if ($verif != null) {
      if ($verif->oper_local == 1 && $verif->oper_international == 1) {
        $pays = DB::table('pays')->orderby('nom_pays')->get();
      } else {
        $pays = DB::table('pays')->where('id', $idpays)->get();
      }
    } else {
      $pays = DB::table('pays')->where('id', $idpays)->get();
    }


    $categories = DB::table('categories')->orderby('code_categorie', 'asc')->get();


    return view('spec_abonne', compact('specs', 'pays', 'categories'));
  }
  public function getmodifpass()
  {
    return view('abonnes/modifpass');
  }

  public function modifpass(Request $request)
  {
    $user = User::find(Auth::user()->id);
    $validator = Validator::make(
      $request->all(),

      [
        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:6'
      ]
    );



    if ($validator->fails()) {

      return redirect(route('modifpass'))->withErrors($validator->errors());
    } else {
      if (Hash::check($request->old, $user->password)) {
        $user->password = Hash::make($request->password);
        $user->save();
        session()->flash('okk', sprintf('Mot de passe modifié avec succès'));
        return redirect(route('modifpass'));
      } else {
        session()->flash('message', sprintf("une erreur s'est produite"));
        return redirect(route('modifpass'));
      }
    }
  }

  public function annuler($id)
  {
    $souscription = DB::table('souscriptions')->where('idsouscription', '=', $id)
      ->join('abonnement', 'abonnement.id', '=', 'souscriptions.idabonnement')
      ->first();
    if ($souscription->date_fin == null && $souscription->iduser == Auth::user()->id) {
      $delete = DB::table('souscriptions')->where('idsouscription', '=', $id)->delete();
      $user = User::find(Auth::user()->id);
      Auth::logout();
      $user->delete();

      return redirect(route('pricing'));
    }
    return redirect()->back();
  }



  public function viewextraitmesref()
  {
    $verif = User::verifabonnement(Auth::user());

    if ($verif->date_fin == null) {
      return redirect(route('home'));
    } elseif ($verif->date_fin < date('Y-m-d')) {
      session()->flash('message', sprintf('Veuillez vous reabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
      return redirect(route('pricing'));
    }


    $references = DB::table('references')
      ->where('status', '=', 1)
      ->where('references.operateur', '=', Auth::user()->ratache_operateur)
      ->orderby('references.created_at', 'desc')
      ->get();
    return view('index_user_extrait ', compact('references'));
  }

  public function postextraitmesref(Request $request)
  {
    $refs = explode("_", $request->idref);
    $taille = sizeof($refs);
    $tab = [$taille - 2];
    for ($i = 0; $i < $taille; $i++) {
      if ($refs[$i] != '') {
        $tab[$i] = $refs[$i];
      }
    }

    $references = DB::table('references')
      ->where('status', '=', 1)
      ->where('references.operateur', '=', Auth::user()->ratache_operateur)
      ->whereIn('references.idreference', $tab)
      ->orderby('references.created_at', 'desc')
      ->get();
    $oper = DB::table('operateurs')
      ->where('operateurs.id', '=', Auth::user()->ratache_operateur)
      ->first()->raison_social;
    //dd($references);
    //$pdf = \PDF::loadView('extrait_to_pdf',compact('references'));
    //return $pdf->download('extrait_to_pdf.pdf');
    //return view('extrait_to_pdf ',compact('references'));


    //pdf
    $html = '<span style="font-size:15px; text-align: center; display: block;">EXTRAIT DE REFERENCES TECHNIQUES (' . $oper . ')</span><br><br><br>';
    $data = $references;

    // Convert data array to HTML table
    $table = '<table border="0.1" cellspacing="0" cellpadding="5"><tr style="background-color: #1b87fa;margin-right:5PX"><th  style="color: white;width:15%">Index</th><th  style="color: white;width:15%">Numéro Contrat</th><th  style="color: white;width:30%">Libellé</th><th  style="color: white;width:25%">Autorité contractante</th><th  style="color: white;width:10%">Année</th></tr>';
    foreach ($data as $row) {
      $table .= '<tr><td>' . $row->numeroreference . '</td><td>' . $row->reference_marche . '</td><td>' . $row->libelle_marche . '</td><td>' . \Illuminate\Support\Facades\DB::table('autoritecontractantes')->where('id', $row->autorite_contractante)->first()->raison_social . '</td><td>' . $row->annee_execution . '</td></tr>';
    }
    $table .= '</table>';
    User::imprimer($html, $table);

    // Write the HTML table to the PDF

  }
}
