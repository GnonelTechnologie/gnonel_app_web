<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class RechercheController extends Controller

{


public function rechercheoffre()

    {

        $data = request()->validate([

            'pays' => ['nullable'],

        ]);



        $pays = DB::table('pays')->orderby('nom_pays')->get();



        $query = DB::table('appeloffres')

            ->join('autoritecontractantes','autoritecontractantes.id','=','appeloffres.id_autorite')

            ->join('categories','categories.id','=','appeloffres.id_categorie')

            ->where('appeloffres.status','=',1)
            ->where('appeloffres.date_cloture','>',date('Y-m-d H:i:s'))

            ->select('appeloffres.*', 'autoritecontractantes.raison_social','categories.nom_categorie')

            ->orderby('appeloffres.created_at','desc');



        // Si un pays spécifique est sélectionné, filtrer par pays
        if (isset($data['pays']) && $data['pays'] && $data['pays'] != '') {
            $query->where('autoritecontractantes.id_pays','=',$data['pays']);
        }



        $offres = $query->get();



        return view('resultat_front',compact('pays','offres','data'));



        

    }
    public function recherche()

    {

        $data = request()->validate([

            'pays' => ['nullable'],

        ]);



        $pays = DB::table('pays')->orderby('nom_pays')->get();



        $query = DB::table('appeloffres')

            ->join('autoritecontractantes','autoritecontractantes.id','=','appeloffres.id_autorite')

            ->join('categories','categories.id','=','appeloffres.id_categorie')

            ->where('appeloffres.status','=',1)
            ->where('appeloffres.date_cloture','>',date('Y-m-d H:i:s'))

            ->select('appeloffres.*', 'autoritecontractantes.raison_social','categories.nom_categorie')

            ->orderby('appeloffres.created_at','desc');



        // Si un pays spécifique est sélectionné, filtrer par pays
        if (isset($data['pays']) && $data['pays'] && $data['pays'] != '') {
            $query->where('autoritecontractantes.id_pays','=',$data['pays']);
        }



        $offres = $query->get();



        return view('resultat',compact('pays','offres','data'));



        

    }


    public function rechercheajax($id)

    {
        $query = DB::table('appeloffres')
            ->join('autoritecontractantes','autoritecontractantes.id','=','appeloffres.id_autorite')
            ->join('categories','categories.id','=','appeloffres.id_categorie')
            ->where('appeloffres.status','=',1)
            ->where('appeloffres.date_cloture','>',date('Y-m-d H:i:s'))
            ->select('appeloffres.*', 'autoritecontractantes.raison_social','categories.nom_categorie')
            ->orderby('appeloffres.created_at','desc');

        // Si un pays spécifique est sélectionné, filtrer par pays
        if ($id && $id != '' && $id != 'null') {
            $query->where('autoritecontractantes.id_pays','=',$id);
        }

        $offres = $query->get();

         return response()->json(
                [
                    "status" => "success",
                    "donnes"=>$offres

                ]);



        

    }



    public function details_offre($id)

    {
       if (!Auth()->check()) {
         session()->flash('message', sprintf('Abonnez-vous pour poursuivre la recherche. '));
    return redirect(url('offre-abonnements'));
        }



        $offres = DB::table('appeloffres')

            ->join('autoritecontractantes','autoritecontractantes.id','=','appeloffres.id_autorite')

            ->join('categories','categories.id','=','appeloffres.id_categorie')

            ->join('pays','pays.id','=','autoritecontractantes.id_pays')

            ->where('appeloffres.id','=',$id)

            ->where('appeloffres.status','=',1)

            ->select('appeloffres.*','pays.nom_pays','autoritecontractantes.raison_social','categories.nom_categorie')

            ->get();



        return view('detailsoffre',compact('offres'));



        

    }

    /**
     * Autocomplétion pour les appels d'offres
     */
    public function autocompleteOffres(Request $request)
    {
        $term = $request->get('term');
        
        $offres = DB::table('appeloffres')
            ->join('autoritecontractantes', 'autoritecontractantes.id', '=', 'appeloffres.id_autorite')
            ->join('categories', 'categories.id', '=', 'appeloffres.id_categorie')
            ->where('appeloffres.status', '=', 1)
            ->where('appeloffres.date_cloture', '>', date('Y-m-d H:i:s'))
            ->where(function($query) use ($term) {
                $query->where('appeloffres.libelle_appel', 'LIKE', '%' . $term . '%')
                      ->orWhere('autoritecontractantes.raison_social', 'LIKE', '%' . $term . '%')
                      ->orWhere('categories.nom_categorie', 'LIKE', '%' . $term . '%');
            })
            ->select('appeloffres.id', 'appeloffres.libelle_appel as value', 'autoritecontractantes.raison_social', 'categories.nom_categorie')
            ->limit(10)
            ->get();

        return response()->json($offres);
    }

    /**
     * Autocomplétion pour les opérateurs économiques
     */
    public function autocompleteOperateurs(Request $request)
    {
        $term = $request->get('term');
        
        $operateurs = DB::table('operateurs')
            ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
            ->where('operateurs.raison_social', 'LIKE', '%' . $term . '%')
            ->select('operateurs.id', 'operateurs.raison_social as value', 'pays.nom_pays')
            ->limit(10)
            ->get();

        return response()->json($operateurs);
    }

    /**
     * Autocomplétion pour les autorités contractantes
     */
    public function autocompleteAutorites(Request $request)
    {
        $term = $request->get('term');
        
        $autorites = DB::table('autoritecontractantes')
            ->join('pays', 'pays.id', '=', 'autoritecontractantes.id_pays')
            ->where('autoritecontractantes.raison_social', 'LIKE', '%' . $term . '%')
            ->select('autoritecontractantes.id', 'autoritecontractantes.raison_social as value', 'pays.nom_pays')
            ->limit(10)
            ->get();

        return response()->json($autorites);
    }

    /**
     * Autocomplétion pour les références techniques
     */
    public function autocompleteReferences(Request $request)
    {
        $term = $request->get('term');
        
        $references = DB::table('references')
            ->join('operateurs', 'operateurs.id', '=', 'references.operateur')
            ->join('autoritecontractantes', 'autoritecontractantes.id', '=', 'references.autorite_contractante')
            ->where('references.status', '=', 1)
            ->where(function($query) use ($term) {
                $query->where('references.libelle_marche', 'LIKE', '%' . $term . '%')
                      ->orWhere('operateurs.raison_social', 'LIKE', '%' . $term . '%')
                      ->orWhere('autoritecontractantes.raison_social', 'LIKE', '%' . $term . '%');
            })
            ->select('references.idreference as id', 'references.libelle_marche as value', 'operateurs.raison_social', 'autoritecontractantes.raison_social')
            ->limit(10)
            ->get();

        return response()->json($references);
    }
    
}

