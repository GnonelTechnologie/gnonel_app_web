<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class PaysController extends Controller
{

    public function view()
    {
        User::admin(Auth::user());
        $pays = DB::table('pays')->orderby('nom_pays')->paginate(20);

        return view('liste_pays', compact('pays'));
    }


    public function create()
    {
        User::admin(Auth::user());
        $data = request()->validate([
            'code' => ['required', 'max:3'],
            'nom' => ['required', 'max:80'],
            'indicatif' => ['nullable'],
        ]);

        $add = DB::table('pays')->insert([
            'code_pays' => $data['code'],
            'nom_pays' => $data['nom'],
            'indicatif' => $data['indicatif'],
            'created_by' => auth()->id(),
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);

        if ($add) {

            return redirect(route('liste_pays'));
        } else {

            dd('Le serveur ne repons reprendre ultérieurement');
        }
    }

    public function update($pays)
    {
        User::admin(Auth::user());
        $updates = DB::table('pays')->where('id', '=', $pays)->limit(1)->get();

        if ($updates) {

            $pays = DB::table('pays')->orderby('nom_pays')->paginate(20);

            return view('update_pays', compact('pays', 'updates'));
        } else {

            dd('fezrfezr');

            return redirect(route('liste_pays'));
        }
    }

    public function add_update($pays)
    {
        User::admin(Auth::user());

        $data = request()->validate([
            'code' => ['required', 'max:3'],
            'nom' => ['required', 'max:80'],
            'status' => ['required'],
            'indicatif' => ['nullable'],
        ]);

        $update = DB::table('pays')
            ->where('id', $pays)
            ->update(['nom_pays' => $data['nom'], 'code_pays' => $data['code'], 'indicatif' => $data['indicatif'], 'status' => $data['status']]);

        if ($update) {

            return redirect(route('liste_pays'))->with('update_ok', '');
        } else {

            return redirect(route('get_update', $pays))->with('update_no', '');
        }
    }

    public function delete($pays)
    {
        $delete = DB::table('pays')->where('id', '=', $pays)->delete();

        if ($delete) {

            return redirect(route('liste_pays'))->with('delete_ok', '');
        } else {

            return redirect(route('get_update', $pays))->with('delete_no', '');
        }
    }

    //Fonction ajax retoumant les autorités contractante d'un pays sélectionné ajaxgetautorite

    public function ajaxgetautorite(Request $request)
    {

        $data = DB::table('autoritecontractantes')
            ->join('pays', 'pays.id', '=', 'autoritecontractantes.id_pays')
            ->where('autoritecontractantes.id_pays', '=', $request->id)
            ->select('autoritecontractantes.id', 'autoritecontractantes.raison_social')->orderby('autoritecontractantes.raison_social', 'asc')
            ->get();

        return response()->json($data);
    }

    //Fonction ajax retoumant les operateurs d'un pays sélectionné ajaxgetautorite

    public function ajaxgetoperateur(Request $request)
    {


        $data = DB::table('operateurs')
            ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
            ->where('operateurs.id_pays', '=', $request->id)
            ->select('operateurs.id', 'operateurs.raison_social')->orderby('operateurs.raison_social', 'ASC')
            ->get();

        return response()->json($data);
    }

    public function ajaxgetoperateurwithreference(Request $request)
    {
        $data = DB::table('operateurs')
            ->join('references', 'references.operateur', '=', 'operateurs.id')
            ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
            ->join('autoritecontractantes', 'autoritecontractantes.id', '=', 'references.autorite_contractante')
            ->join('categories', 'categories.id', '=', 'references.type_marche')
            ->select('operateurs.id', 'operateurs.raison_social', 'operateurs.id_pays', DB::raw('COUNT(references.idreference) as total_references'))
            ->where('references.status', '=', 1)
            ->where('operateurs.id_pays', '=', $request->id)
            ->groupBy('operateurs.id', 'operateurs.raison_social', 'operateurs.id_pays')
            ->havingRaw('COUNT(references.idreference) >= 1')
            ->orderBy('operateurs.raison_social', 'ASC')
            ->get();
        return response()->json($data);
    }


    public function ajaxgetoperateur_autorite(Request $request)
    {

        if ($request->type == 'autorite') {

            $data = DB::table('autoritecontractantes')
                ->join('pays', 'pays.id', '=', 'autoritecontractantes.id_pays')
                ->where('autoritecontractantes.id_pays', '=', $request->id)
                ->select('autoritecontractantes.id', 'autoritecontractantes.raison_social')->orderby('autoritecontractantes.raison_social', 'asc')->get();

            return response()->json($data);
        } else {

            $data = DB::table('operateurs')
                ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
                ->where('operateurs.id_pays', '=', $request->id)
                ->select('operateurs.id', 'operateurs.raison_social')->orderby('operateurs.raison_social', 'ASC')->get();

            return response()->json($data);
        }
    }


    public function ajaxgetoperateur_jfe(Request $request)
    {

        $liste = array();
        if ($request->type == 'oui') {
            $data = DB::table('operateurs')
                ->select('operateurs.id', 'operateurs.raison_social', DB::raw('MAX(souscriptions.idsouscription) as max_idsouscription'))
                ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
                ->join('users', 'users.ratache_operateur', '=', 'operateurs.id')
                ->join('souscriptions', 'souscriptions.iduser', '=', 'users.id')
                ->where('operateurs.jfe', '=', true)
                ->where('operateurs.zone_id', '=', $request->zone)
                ->where('operateurs.id_pays', $request->pays)
                ->where('souscriptions.date_fin', '>=', date('Y-m-d'))
                ->groupBy('operateurs.id', 'operateurs.raison_social')
                ->orderBy('operateurs.raison_social', 'asc')
                ->get();
            /*$data = DB::table('operateurs')
                ->join('pays','pays.id','=','operateurs.id_pays')
                ->where('operateurs.jfe', '=',true)
                ->where('operateurs.zone_id', '=', $request->zone)
                ->select('operateurs.id', 'operateurs.raison_social')->orderby('operateurs.raison_social','ASC')->get();

                foreach($data as $d){
                    $temp=DB::table('operateurs')
                ->join('users','users.ratache_operateur','=','operateurs.id')
                ->join('souscriptions','souscriptions.iduser','=','users.id')
                ->where('operateurs.id', '=',$d->id)
                 ->where('operateurs.zone_id', '=', $request->zone)
                ->select('operateurs.id', 'operateurs.raison_social','souscriptions.date_fin')->orderby('souscriptions.idsouscription','ASC')->first();
                if ($temp!=null) {
                   if ($temp->date_fin>=date('Y-m-d')) {
                   array_push($liste, $d);
                }

                }
               
                }*/

            return response()->json($data);
        } else {
            $data = DB::table('operateurs')
                ->select('operateurs.id', 'operateurs.raison_social', DB::raw('MAX(souscriptions.idsouscription) as max_idsouscription'))
                ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
                ->join('users', 'users.ratache_operateur', '=', 'operateurs.id')
                ->join('souscriptions', 'souscriptions.iduser', '=', 'users.id')
                ->where(function ($query) {
                    $query->where('operateurs.jfe', 0)
                        ->orWhereNull('operateurs.jfe');
                })
                ->where('operateurs.id_pays', $request->pays)
                ->where('souscriptions.date_fin', '>=', date('Y-m-d'))
                ->groupBy('operateurs.id', 'operateurs.raison_social')
                ->orderBy('operateurs.raison_social', 'asc')
                ->get();

            /*$data = DB::table('operateurs')
                ->join('pays','pays.id','=','operateurs.id_pays')
                ->join('users','users.ratache_operateur','=','operateurs.id')
                ->join('souscriptions','souscriptions.iduser','=','users.id')
                ->where('operateurs.jfe', '=',false)
                ->orwhere('operateurs.jfe', '=',null)
                ->where('operateurs.id_pays', '=', $request->pays)
                ->where('souscriptions.date_fin', '>=',date('Y-m-d'))
                ->select('operateurs.id', 'operateurs.raison_social','max(souscriptions.idsouscription)')->orderby('operateurs.raison_social','ASC')->get();
                /* foreach($data as $d){
                    $temp=DB::table('operateurs')
                ->join('users','users.ratache_operateur','=','operateurs.id')
                ->join('souscriptions','souscriptions.iduser','=','users.id')
                ->where('operateurs.id_pays', '=', $request->pays)
                ->where('operateurs.id', '=',$d->id)
                ->select('operateurs.id', 'operateurs.raison_social','souscriptions.date_fin')->orderby('souscriptions.idsouscription','ASC')->first();
                 if ($temp!=null) {
                   if ($temp->date_fin>=date('Y-m-d')) {
                    array_push($liste, $d);
                }

                }

                }
                */
            return response()->json($data);
        }
    }
}
