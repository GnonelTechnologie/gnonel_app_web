<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperateurController extends Controller
{

    public function view_created()
    {
        $users = DB::table('users')->orderby('created_at','desc')->get();
        $pays = DB::table('pays')->orderby('nom_pays')->get();
        $secteur_activites = DB::table('secteuractivite')
            ->select('secteuractivite.*')
            ->orderby('libellesecteuractivite')
            ->get();
        return view('create_operateur',compact('users','pays','secteur_activites'));
    }

    public function view()
    {
        $secteur_activites = DB::table('secteuractivite')
            ->select('secteuractivite.*')
            ->orderby('libellesecteuractivite')
            ->get();
        $users = DB::table('users')->orderby('created_at','desc')->get();
        $pays = DB::table('pays')->orderby('nom_pays')->get();

        $operateurs = DB::table('operateurs')
            ->join('users','users.id','=','operateurs.id_user')
            ->join('pays','pays.id','=','operateurs.id_pays')
            ->select('operateurs.*', 'users.name','pays.nom_pays')->orderby('users.name','ASC')
            ->paginate(200);
            

        return view('liste_operateur',compact('operateurs','users','pays','secteur_activites'));
    }
    
    //Fonction de recherche
    
    public function Rechercher()
    {
        $data = request()->validate([
            'recherche' => ['required'],
        ]);
        
        $users = DB::table('users')->orderby('created_at','desc')->get();
        $pays = DB::table('pays')->orderby('nom_pays')->get();

        $operateurs = DB::table('operateurs')
            ->join('users','users.id','=','operateurs.id_user')
            ->join('pays','pays.id','=','operateurs.id_pays')
            ->select('operateurs.*', 'users.name','pays.nom_pays')->orderby('users.name','ASC')
            ->where('users.name','LIKE','%'.$data['recherche'].'%')
            ->paginate(200);
    
        return view('liste_operateur',compact('operateurs','users','pays'));
    }


    public function create()
    {

        
        $data = request()->validate([
            'name' => ['required','max:100','string','unique:users'],
            'mail' => ['nullable','email'],
            'pays' => ['required', 'numeric','gt:0'],
            'num_fiscal' => ['nullable','max:100'],
            'description' => ['required','max:254'],
            'secteur'=>['nullable'],
        ]);
        
        
        $okcreat = DB::transaction(function() use($data)
            {

                $numfiscal =null;
                if ($data['num_fiscal'] == '') {

                    $numfiscal ='null';

                }else {
                    $numfiscal = $data['num_fiscal'];
                }

                if ($data['mail'] == null) {

                    $newuser = DB::table('users')->insert([
                        'name' => $data['name'],
                        'type_user' => 1,
                        'created_by' => auth()->id(),
                        'created_at' => NOW(),
                        'updated_at' => NOW(),
                    ]);

                    $idop = DB::table('users')
                        ->where('name','=',$data['name'])
                        ->select('id')
                        ->get();

                    $adduser = DB::table('operateurs')->insert([
                        'raison_social' => $data['name'],
                        'id_pays' => $data['pays'],
                        'des_operateur' => $data['description'],
                        'secteuractivite_id'=>$data['secteur'],
                        'num_fiscal' => $numfiscal,
                        'created_by' => auth()->id(),
                        'created_at' => NOW(),
                        'updated_at' => NOW(),

                    ]);

                    return $adduser;

                }else {

                    $newuser = DB::table('users')->insert([
                        'name' => $data['name'],
                        'type_user' => 1,
                        'email' => $data['mail'],
                        'created_by' => auth()->id(),
                        'created_at' => NOW(),
                        'updated_at' => NOW(),
                    ]);

                    $idop = DB::table('users')
                        ->where('name','=',$data['name'])
                        ->select('id')
                        ->get();
                        
                    $adduser = DB::table('operateurs')->insert([
                        'id_user' => $idop[0]->id,
                        'id_pays' => $data['pays'],
                        'des_operateur' => $data['description'],
                        'secteuractivite_id'=>$data['secteur'],
                        'num_fiscal' => $numfiscal,
                        'created_by' => auth()->id(),
                        'created_at' => NOW(),
                        'updated_at' => NOW(),
                    ]);

                    return $adduser;
                }

            });

        if ($okcreat) {

            return redirect(route('liste_operateur'))->with('add_ok', '');

        } else {

            dd('error');
        }


    }

    public function update($operateur)
    {

        $updates = DB::table('operateurs')
            ->join('users','users.id','=','operateurs.id_user')
            ->leftjoin('secteuractivite','secteuractivite.idsecteuractivite','=','operateurs.secteuractivite_id')
            ->select('operateurs.*', 'users.name','users.email')
            ->where('operateurs.id','=',$operateur)->limit(1)->get();
         
 $secteur_activites = DB::table('secteuractivite')
            ->select('secteuractivite.*')
            ->orderby('libellesecteuractivite')
            ->get();
        $operateurs = DB::table('operateurs')
            ->join('users','users.id','=','operateurs.id_user')
            ->join('pays','pays.id','=','operateurs.id_pays')
            ->select('operateurs.*', 'users.name','pays.nom_pays')->orderby('operateurs.created_at','desc')
            ->paginate(200);
        
        if($updates){

            $users = DB::table('users')->orderby('created_at','desc')->get();
            $pays = DB::table('pays')->orderby('nom_pays')->get();

            return view('update_operateur',compact('pays','updates','operateurs','secteur_activites'));

        }else{

            dd('fezrfezr');

            return redirect(route('liste_pays'));

        }
    }

    public function add_update($operateur)
    {

        $data = request()->validate([
            'name' => ['required','string'],
            'mail' => ['nullable','email'],
            'pays' => ['required', 'numeric','gt:0'],
            'num_fiscal' => ['required','max:100'],
            'description' => ['required','max:254'],
            'secteur'=>['required'],
        ]);

        $iduser = DB::table('operateurs')
        ->select('operateurs.id_user')
        ->where('operateurs.id','=',$operateur)->limit(1)->get();

        $iduser = $iduser[0]->id_user;

        $updateuser = DB::table('users')
            ->where('id', $iduser)
            ->update(['name' => $data['name'],'email' => $data['mail']]);

        $update = DB::table('operateurs')
            ->where('id', $operateur)
            ->update(['id_pays' => $data['pays'],'secteuractivite_id'=>$data['secteur'],'num_fiscal' => $data['num_fiscal'],'des_operateur' => $data['description']]);

    
        if ($update || $updateuser) {

            return redirect(route('liste_operateur'))->with('update_ok', '');

        } else {

            return redirect(route('liste_operateur'))->with('update_no', '');
        }

        


    }

    public function delete($operateur)
    {
        $delete = DB::table('operateurs')->where('id', '=', $operateur)->delete();

        if ($delete) {

            return redirect(route('liste_operateur'))->with('delete_ok', '');

        } else {

            return redirect(route('liste_operateur',$operateur))->with('delete_no', '');
        }

    }

}
