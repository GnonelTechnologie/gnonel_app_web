<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Zone;
use App\Basefour;
use Carbon\Carbon;

class BasefourController extends Controller
{
  public function index()
  {
    $verif = User::verifabonnement(Auth::user());
    $pays = DB::table('pays')->get();
    $pays = null;
    $idpays = "";
    $bases = Basefour::where('user_id', '=', Auth::user()->id)->get();
    if (Auth::user()->ratache_operateur != null) {
      $idpays = DB::table('operateurs')->where('id', Auth::user()->ratache_operateur)->first()->id_pays;
    }
    if (Auth::user()->ratache_autorite != null) {
      $idpays = DB::table('autoritecontractantes')->where('id', Auth::user()->ratache_autorite)->first()->id_pays;
    }


    if ($verif->date_fin == null) {
      return redirect(route('home'));
    } elseif ($verif->date_fin < date('Y-m-d')) {
      session()->flash('message', sprintf('Veuillez vous reabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
      return redirect(route('pricing'));
    }



    if ($verif->oper_local == 1 && $verif->oper_international == 1) {
      $pays = DB::table('pays')->orderby('nom_pays')->get();
    } else {
      $pays = DB::table('pays')->where('id', $idpays)->get();
      //n'afficher que le pays que la personne qui s'est connecter
    }

    $bases = Basefour::where('user_id', '=', Auth::user()->id)->get();
    return view('bases/index', compact('bases', 'pays'));
  }
  public function create()
  {
    $verif = User::verifabonnement(Auth::user());
    $abon = \app\User::verifabonnement(\Illuminate\Support\Facades\Auth::user());
    $pays = null;
    $idpays = "";
    $bases = Basefour::where('user_id', '=', Auth::user()->id)->get();
    if (Auth::user()->ratache_operateur != null) {
      $idpays = DB::table('operateurs')->where('id', Auth::user()->ratache_operateur)->first()->id_pays;
    }
    if (Auth::user()->ratache_autorite != null) {
      $idpays = DB::table('autoritecontractantes')->where('id', Auth::user()->ratache_autorite)->first()->id_pays;
    }

    if ($verif->date_fin == null) {
      return redirect(route('home'));
    } elseif ($verif->date_fin < date('Y-m-d')) {
      session()->flash('message', sprintf('Veuillez vous reabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
      return redirect(route('pricing'));
    }

    if ($abon->oper_local == 1 && $abon->oper_international == 1) {
      $pays = DB::table('pays')->orderby('nom_pays')->get();
    } else {
      $pays = DB::table('pays')->where('id', $idpays)->get();
      //n'afficher que le pays que la personne qui s'est connecter
    }

    //$pays = DB::table('pays')->orderby('nom_pays')->get();
    $zones = Zone::all();

    return view('bases/create', compact('zones', 'pays', 'bases'));
  }

  public function store(Request $request)
  {
    $verif = User::verifabonnement(Auth::user());
    if ($verif->date_fin == null) {
      return redirect(route('home'));
    } elseif ($verif->date_fin < date('Y-m-d')) {
      session()->flash('message', sprintf('Veuillez vous reabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
      return redirect(route('pricing'));
    }

    $validator = Validator::make(
      $request->all(),

      [
        'structure' =>  'required',
      ]
    );



    if ($validator->fails()) {

      return redirect(route('basefournisseurs.create'))->withErrors($validator->errors());
    } else {

      $basefour = new Basefour;
      $basefour->user_id = Auth::user()->id;
      $basefour->operateur_id = $request->structure;
      // $basefour->numerorccm = $request->numerorccm;
      $basefour->save();
      return redirect()->route('basefournisseurs.create')->with('add_ok', '');
    }
  }

  public function edit($id)
  {
    $verif = User::verifabonnement(Auth::user());

    if ($verif->date_fin == null) {
      return redirect(route('home'));
    } elseif ($verif->date_fin < date('Y-m-d')) {
      session()->flash('message', sprintf('Veuillez vous reabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
      return redirect(route('pricing'));
    }

    $base = Basefour::find($id);
    $pays = DB::table('pays')->orderby('nom_pays')->get();
    $zones = Zone::all();
    $bases = Basefour::where('user_id', '=', Auth::user()->id)->get();
    return view('bases/create', compact('base', 'bases', 'pays', 'zones'));
  }

  public function update($id, Request $request)
  {
    $basefour = Basefour::find($id);
    $validator = Validator::make(
      $request->all(),

      [
        'structure' =>  'required',
      ]
    );



    if ($validator->fails()) {

      return redirect(route('basefournisseurs.edit', 'base'))->withErrors($validator->errors());
    } else {

      $basefour->operateur_id = $request->structure;
      // $basefour->numerorccm = $request->numerorccm;
      $basefour->save();
      return redirect()->route('basefournisseurs.create')->with('update_ok', '');
    }
  }

  public function delete($id)
  {
    $base = Basefour::find($id);
    $base->delete();
    return redirect()->route('basefournisseurs.create')->with('delete_ok', '');
  }

  public function searchreference(Request $request)
  {
    $references = DB::table('references')
      ->join('operateurs', 'operateurs.id', '=', 'references.operateur')
      ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
      ->join('users', 'users.id', '=', 'operateurs.id_user')
      //->join('souscriptions', 'souscriptions.iduser', '=', 'users.id')
      ->where('pays.id', $request->pays)
      ->where('references.libelle_marche', 'like', '% ' . $request->reference . ' %')
      ->select('references.*', 'operateurs.raison_social as operateur', 'operateurs.gnonelid as gnonelid', 'pays.id as pays_id', 'operateurs.id as operateur_id')->orderby('references.created_at', 'desc')
      ->get();
    return response()->json($references);
  }
}
