<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class OffreController extends Controller
{

    public function view_created()
    {
        User::admin(Auth::user());

        $autoritecontractantes = DB::table('autoritecontractantes')
            ->join('users', 'users.id', '=', 'autoritecontractantes.id_user')
            ->join('pays', 'pays.id', '=', 'autoritecontractantes.id_pays')
            ->select('autoritecontractantes.*', 'users.name', 'pays.nom_pays')->orderby('autoritecontractantes.created_at', 'desc')
            ->get();

        $categories = DB::table('categories')->orderby('nom_categorie')->get();
        $modes = DB::table('modes')->orderby('libelle')->get();

        $pays = DB::table('pays')->orderby('nom_pays')->get();
        $secteur_activites = DB::table('secteuractivite')
            ->select('secteuractivite.*')
            ->orderby('libellesecteuractivite')
            ->get();

        return view('create_offre', compact('autoritecontractantes', 'categories', 'pays', 'secteur_activites', 'modes'));
    }

    public function view()
    {
        User::admin(Auth::user());
        // Get adresse ip du visiteur qui navigue ..

        // function getIp(){
        // if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //   $ip = $_SERVER['HTTP_CLIENT_IP'];
        // }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        // }else{
        //   $ip = $_SERVER['REMOTE_ADDR'];
        // }
        // return $ip;
        // }

        // dd(getIp());

        $offres = DB::table('appeloffres')
            ->join('autoritecontractantes', 'autoritecontractantes.id', '=', 'appeloffres.id_autorite')
            ->join('pays', 'pays.id', '=', 'autoritecontractantes.id_pays')
            ->join('categories', 'categories.id', '=', 'appeloffres.id_categorie')
            ->join('secteuractivite', 'secteuractivite.idsecteuractivite', '=', 'appeloffres.idsecteuractivite')
            ->leftjoin('modes', 'modes.id', '=', 'appeloffres.mode_id')

            ->select('appeloffres.*', 'pays.nom_pays', 'secteuractivite.libellesecteuractivite', 'modes.libelle', 'autoritecontractantes.raison_social', 'categories.nom_categorie')->orderby('appeloffres.created_at', 'desc')
            ->paginate(5);

        $autoritecontractantes = DB::table('autoritecontractantes')
            ->join('users', 'users.id', '=', 'autoritecontractantes.id_user')
            ->join('pays', 'pays.id', '=', 'autoritecontractantes.id_pays')
            ->select('autoritecontractantes.*', 'users.name', 'pays.nom_pays')->orderby('autoritecontractantes.created_at', 'desc')
            ->get();

        $secteur_activites = DB::table('secteuractivite')
            ->select('secteuractivite.*')
            ->orderby('libellesecteuractivite')
            ->get();

        $categories = DB::table('categories')->orderby('nom_categorie')->get();

        $pays = DB::table('pays')->orderby('nom_pays')->get();

        return view('liste_offre', compact('offres', 'secteur_activites', 'autoritecontractantes', 'categories', 'pays'));
    }


    public function create()
    {
        User::admin(Auth::user());
        $data = request()->validate([
            'categorie' => ['required', 'numeric', 'gt:0'],
            'autorite' => ['required', 'numeric', 'gt:0'],
            'secteur' => ['required'],
            'reference' => ['required', 'max:100'],
            'libelle' => ['required', 'max:254'],
            'source' => ['required', 'max:50'],
            'date_publication' => ['required', 'date'],
            'date_cloture' => ['required', 'date', 'after:date_publication'],
            'description' => ['required'],
            'mode' => ['required'],
            'contact' => ['required'],
        ]);
        $add = DB::table('appeloffres')->insert([
            'id_autorite' => $data['autorite'],
            'id_categorie' => $data['categorie'],
            'idsecteuractivite' => $data['secteur'],
            'reference' => $data['reference'],
            'libelle_appel' => $data['libelle'],
            'date_publication' => $data['date_publication'],
            'date_cloture' => $data['date_cloture'],
            'source' => $data['source'],
            'description' => $data['description'],
            'created_by' => auth()->id(),
            'created_at' => NOW(),
            'updated_at' => NOW(),
            'mode_id' => $data['mode'],
            'contact' => $data['contact'],
        ]);

        if ($add) {

            return redirect(route('liste_offre'))->with('add_ok', "Nouvelle offre d'appel ajouté avec succès");
        } else {

            dd('error');
        }
    }


    //Modification d'une offre

    public function update($offre)
    {
        User::admin(Auth::user());
        $offres = DB::table('appeloffres')
            ->join('autoritecontractantes', 'autoritecontractantes.id', '=', 'appeloffres.id_autorite')
            ->join('users', 'users.id', '=', 'autoritecontractantes.id_user')
            ->join('categories', 'categories.id', '=', 'appeloffres.id_categorie')
            ->select('appeloffres.*', 'users.name', 'categories.nom_categorie')->orderby('appeloffres.created_at', 'desc')
            ->paginate(5);

        $updates = DB::table('appeloffres')->where('id', '=', $offre)->limit(1)->get();

        if ($updates) {

            $autoritecontractantes = DB::table('autoritecontractantes')
                ->join('users', 'users.id', '=', 'autoritecontractantes.id_user')
                ->join('pays', 'pays.id', '=', 'autoritecontractantes.id_pays')
                ->select('autoritecontractantes.*', 'users.name', 'pays.nom_pays')->orderby('autoritecontractantes.created_at', 'desc')
                ->get();

            $secteur_activites = DB::table('secteuractivite')
                ->select('secteuractivite.*')
                ->orderby('libellesecteuractivite')
                ->get();
            $categories = DB::table('categories')->orderby('nom_categorie')->get();
            $modes = DB::table('modes')->orderby('libelle')->get();
            $pays = DB::table('pays')->orderby('nom_pays')->get();
            return view('update_offre', compact('offres', 'autoritecontractantes', 'secteur_activites', 'categories', 'updates', 'modes', 'pays'));
        } else {

            return redirect(route('liste_offre'));
        }
    }

    public function add_update($offre)
    {
        User::admin(Auth::user());

        $data = request()->validate([
            'categorie' => ['required', 'numeric', 'gt:0'],
            'autorite' => ['required', 'numeric', 'gt:0'],
            'secteur' => ['required'],
            'libelle' => ['required'],
            'source' => ['required'],
            'date_publication' => ['required', 'date'],
            'date_cloture' => ['required', 'date', 'after:date_publication'],
            'description' => ['required'],
            'mode' => ['required'],
            'contact' => ['required'],
        ]);

        $update = DB::table('appeloffres')
            ->where('id', $offre)
            ->update([
                'id_autorite' => $data['autorite'],
                'id_categorie' => $data['categorie'],
                'idsecteuractivite' => $data['secteur'],
                'libelle_appel' => $data['libelle'],
                'date_publication' => $data['date_publication'],
                'date_cloture' => $data['date_cloture'],
                'source' => $data['source'],
                'description' => $data['description'],
                'updated_by' => auth()->id(),
                'updated_at' => NOW(),
                'mode_id' => $data['mode'],
                'contact' => $data['contact'],
            ]);

        if ($update) {

            return redirect(route('liste_offre'))->with('update_ok', "Offre modifiée avec succès");
        } else {

            return redirect(route('get_update_offre', $offre))->with('update_no', "Echec de la modification de l'offre");
        }
    }

    public function delete($offre)
    {
        User::admin(Auth::user());
        $delete = DB::table('appeloffres')->where('id', '=', $offre)->delete();

        if ($delete) {

            return redirect(route('liste_offre'))->with('delete_ok', "Offre supprimée avec succès");
        } else {

            return redirect(route('get_update_offre', $offre))->with('delete_no', "Echec de la suppression de l'offre");
        }
    }

    public function activer_offre($offre)
    {
        User::admin(Auth::user());
        $update = DB::table('appeloffres')
            ->where('id', $offre)
            ->update(['status' => 1]);

        return redirect(route('liste_offre'))->with('update_ok', "Offre activée avec succès");
    }


    public function cloturer_offre($offre)
    {
        User::admin(Auth::user());
        $update = DB::table('appeloffres')
            ->where('id', $offre)
            ->update(['status' => 0]);

        return redirect(route('liste_offre'))->with('update_ok', "Offre clôturée avec succès");
    }

    public function viewsecteur_activite()
    {
        $secteur_activites = DB::table('secteuractivite')
            ->select('secteuractivite.*')
            ->orderby('libellesecteuractivite')
            ->paginate(10);

        return view('secteuractivite', compact('secteur_activites'));
    }

    public function addsecteur_activite()
    {
        $secteur_activites = DB::table('secteuractivite')
            ->select('secteuractivite.*')
            ->orderby('codesecteur', 'desc')
            ->paginate(50);
        dd($secteur_activites);

        return view('secteuractivite', compact('secteur_activites'));
    }

    public function createsecteur_activite()
    {
        User::admin(Auth::user());

        $data = request()->validate([
            'code' => ['required', 'max:3'],
            'libelle' => ['required', 'max:100']
        ]);


        $add = DB::table('secteuractivite')->insert([
            'codesecteur' => $data['code'],
            'libellesecteuractivite' => $data['libelle']
        ]);

        if ($add) {

            return redirect(route('viewsecteur_activite'))->with('add_ok', "Secteur d'activité créé avec succès");
        } else {

            return redirect(route('viewsecteur_activite'))->with('add_no', "Echec lors de la création du secteur d'activité");
        }
    }

    public function deletesecteur_activite($id)
    {
        User::admin(Auth::user());
        $delete = DB::table('secteuractivite')->where('idsecteuractivite', '=', $id)->delete();

        if ($delete) {

            return redirect(route('viewsecteur_activite'))->with('delete_ok', '');
        } else {

            return redirect(route('viewsecteur_activite', $offre))->with('delete_no', '');
        }
    }

    public function updatesecteur_activite($id)
    {
        User::admin(Auth::user());

        //dd('En maintenance');
        $secteur_activites = DB::table('secteuractivite')
            ->select('secteuractivite.*')
            ->orderby('libellesecteuractivite')
            ->paginate(50);

        $updates = DB::table('secteuractivite')->where('idsecteuractivite', '=', $id)->limit(1)->get();

        if ($updates) {

            return view('updatesecteuractivite', compact('secteur_activites', 'updates'));
        } else {

            return redirect(route('viewsecteur_activite'));
        }
    }
}
