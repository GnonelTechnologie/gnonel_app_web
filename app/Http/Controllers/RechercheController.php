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



        $offres = DB::table('appeloffres')

            ->join('autoritecontractantes','autoritecontractantes.id','=','appeloffres.id_autorite')

            ->join('categories','categories.id','=','appeloffres.id_categorie')

            ->where('autoritecontractantes.id_pays','=',$data['pays'])

            ->where('appeloffres.status','=',1)
            ->where('appeloffres.date_cloture','>',date('Y-m-d H:i:s'))

            ->select('appeloffres.*', 'autoritecontractantes.raison_social','categories.nom_categorie')->orderby('appeloffres.created_at','desc')

            ->get();



        return view('resultat_front',compact('pays','offres','data'));



        

    }
    public function recherche()

    {

        $data = request()->validate([

            'pays' => ['nullable'],

        ]);



        $pays = DB::table('pays')->orderby('nom_pays')->get();



        $offres = DB::table('appeloffres')

            ->join('autoritecontractantes','autoritecontractantes.id','=','appeloffres.id_autorite')

            ->join('categories','categories.id','=','appeloffres.id_categorie')

            ->where('autoritecontractantes.id_pays','=',$data['pays'])

            ->where('appeloffres.status','=',1)
            ->where('appeloffres.date_cloture','>',date('Y-m-d H:i:s'))

            ->select('appeloffres.*', 'autoritecontractantes.raison_social','categories.nom_categorie')->orderby('appeloffres.created_at','desc')

            ->get();



        return view('resultat',compact('pays','offres','data'));



        

    }


    public function rechercheajax($id)

    {
        $offres = DB::table('appeloffres')

            ->join('autoritecontractantes','autoritecontractantes.id','=','appeloffres.id_autorite')

            ->join('categories','categories.id','=','appeloffres.id_categorie')

            ->where('autoritecontractantes.id_pays','=',$id)

            ->where('appeloffres.status','=',1)
            ->where('appeloffres.date_cloture','>',date('Y-m-d H:i:s'))
            ->select('appeloffres.*', 'autoritecontractantes.raison_social','categories.nom_categorie')->orderby('appeloffres.created_at','desc')
            ->get();



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

    

}

