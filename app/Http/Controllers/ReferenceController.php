<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class ReferenceController extends Controller
{
    public function view()
    {

        User::admin(Auth::user());
        $operateurs = DB::table('operateurs')
            ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
            ->select('operateurs.*', 'pays.nom_pays')->orderby('operateurs.raison_social', 'ASC')
            ->get();

        $references = DB::table('references')
            ->join('operateurs', 'operateurs.id', '=', 'references.operateur')
            ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
            ->join('autoritecontractantes', 'autoritecontractantes.id', '=', 'references.autorite_contractante')
            ->join('pays as p', 'p.id', '=', 'autoritecontractantes.id_pays')
            ->join('categories', 'categories.id', '=', 'references.type_marche')
            ->select('references.*', 'autoritecontractantes.raison_social as autorite_contractante', 'operateurs.raison_social as operateur', 'nom_categorie', 'p.nom_pays as paysop', 'pays.nom_pays as paysau')->orderby('references.created_at', 'desc')
            ->paginate(200);

        $categories = DB::table('categories')->orderby('code_categorie', 'asc')->get();

        $pays = DB::table('pays')->orderby('nom_pays')->get();


        // dd('ok reference');
        return view('liste_reference', compact('pays', 'operateurs', 'categories', 'references'));
    }


    public function view_create()
    {

        User::admin(Auth::user());
        $operateurs = DB::table('operateurs')
            ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
            ->select('operateurs.*', 'pays.nom_pays')->orderby('operateurs.raison_social', 'ASC')
            ->get();
        $categories = DB::table('categories')->orderby('code_categorie', 'asc')->get();

        $pays = DB::table('pays')->orderby('nom_pays')->get();


        // dd('ok reference');
        return view('create_reference', compact('pays', 'operateurs', 'categories'));
    }


    public function create(Request $request)
    {
        User::admin(Auth::user());
        $data = request()->validate([
            'reference' => ['required', 'max:50'],
            'sous_traitance' => ['nullable'],
            'autorite' => ['required'],
            'annee_execution' => ['required'],
            'titulaire' => ['required', 'numeric', 'gt:0'],
            'type' => ['required', 'numeric', 'gt:0'],
            'marche' => ['required', 'string'],
            'compte' => ['required', 'string'],
            'groupement' => ['required', 'string'],
            'montant' => ['nullable', 'numeric'],
            'date_contrat' => ['nullable'],

        ]);

        // dd(request()->file('preuve_execution'));


        /* if ($image = request()->file('preuve_execution')) {
            $destinationPath = 'storage/app/public/references';
            $preuve_execution = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $preuve_execution);
        }*/


        $add = DB::table('references')->insert([
            'reference_marche' => $data['reference'],
            'numeroreference' => User::genereId(),
            'date_contrat' => $data['date_contrat'],
            'libelle_marche' => $data['marche'],
            'type_marche' => $data['type'],
            'montant' => $data['montant'],
            'preuve_execution' => User::showUploadFile($request->file('preuve_execution')),
            'annee_execution' => $data['annee_execution'],
            'autorite_contractante' => $data['autorite'],
            'sous_traitance' => $data['sous_traitance'],
            'operateur' => $data['titulaire'],
            'compte' => $data['compte'],
            'groupement' => $data['groupement'],
            'status' => 0,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);

        return redirect(route('liste_reference'));
    }

    public function update($id, Request $request)
    {
        User::admin(Auth::user());
        $operateurs = DB::table('operateurs')
            ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
            ->select('operateurs.*', 'pays.nom_pays')->orderby('operateurs.raison_social', 'ASC')
            ->get();

        $reference = DB::table('references')
            ->join('operateurs', 'operateurs.id', '=', 'references.operateur')
            ->join('autoritecontractantes', 'autoritecontractantes.id', '=', 'references.autorite_contractante')
            ->join('categories', 'categories.id', '=', 'references.type_marche')
            ->where('references.idreference', '=', $id)
            ->select('references.*', 'autoritecontractantes.id as autorite_contractante', 'operateurs.id as operateur', 'nom_categorie')->first();

        $categories = DB::table('categories')->orderby('code_categorie', 'asc')->get();

        $pays = DB::table('pays')->orderby('nom_pays')->get();


        // dd('ok reference');
        return view('create_reference', compact('pays', 'operateurs', 'categories', 'reference'));
    }

    public function add_update($id, Request $request)
    {
        User::admin(Auth::user());
        $data = request()->validate([
            'reference' => ['required', 'max:50'],
            'sous_traitance' => ['nullable'],
            'autorite' => ['required'],
            'annee_execution' => ['required'],
            'titulaire' => ['required', 'numeric', 'gt:0'],
            'type' => ['required', 'numeric', 'gt:0'],
            'marche' => ['required', 'string'],
            'compte' => ['required', 'string'],
            'groupement' => ['required', 'string'],
            'montant' => ['nullable', 'numeric'],
            'date_contrat' => ['nullable'],

        ]);




        /*if ($image = request()->file('preuve_execution')) {
            $destinationPath = 'storage/app/public/references';
            $preuve_execution = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $preuve_execution);
        }*/

        if ($request->file('preuve_execution') == null) {
            $add = DB::table('references')
                ->where('idreference', $id)
                ->update([
                    'date_contrat' => $data['date_contrat'],
                    'reference_marche' => $data['reference'],
                    'libelle_marche' => $data['marche'],
                    'type_marche' => $data['type'],
                    'montant' => $data['montant'],
                    'annee_execution' => $data['annee_execution'],
                    'autorite_contractante' => $data['autorite'],
                    'sous_traitance' => $data['sous_traitance'],
                    'operateur' => $data['titulaire'],
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
                    'date_contrat' => $data['date_contrat'],
                    'reference_marche' => $data['reference'],
                    'libelle_marche' => $data['marche'],
                    'type_marche' => $data['type'],
                    'montant' => $data['montant'],
                    'annee_execution' => $data['annee_execution'],
                    'preuve_execution' => User::showUploadFile($request->file('preuve_execution')),
                    'autorite_contractante' => $data['autorite'],
                    'sous_traitance' => $data['sous_traitance'],
                    'operateur' => $data['titulaire'],
                    'compte' => $data['compte'],
                    'groupement' => $data['groupement'],
                    'status' => 0,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]);
        }

        return redirect(route('liste_reference'))->with('update_ok', '');
    }

    public function valider($id)
    {
        $update = DB::table('references')
            ->where('idreference', $id)
            ->update([
                'status' => 1,
            ]);
        if ($update) {
            return redirect()->route('liste_reference')->with('update_ok', '');
        }
        return redirect()->route('liste_reference');
    }

    public function rejeter($id)
    {
        $update = DB::table('references')
            ->where('idreference', $id)
            ->update([
                'status' => 2,
            ]);
        if ($update) {
            return redirect()->route('liste_reference')->with('update_ok', '');
        }
        return redirect()->route('liste_reference');
    }
    public function delete($id)
    {
        $delete = DB::table('references')->where('idreference', '=', $id)->delete();
        if ($delete) {
            return redirect()->route('liste_reference')->with('delete_ok', '');
        }
        return redirect()->route('liste_reference');
    }
}
