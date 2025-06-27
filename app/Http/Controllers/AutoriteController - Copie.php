<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Categorieautorite;

class AutoriteController extends Controller
{

    public function view_created()
    {
        $users = DB::table('users')->orderby('created_at','desc')->get();
        $pays = DB::table('pays')->orderby('nom_pays')->get();
        $categories=Categorieautorite::all();
        return view('create_autorite',compact('users','pays','categories'));
    }

    public function view()
    {

        $pays = DB::table('pays')->orderby('nom_pays')->get();
        $categories=Categorieautorite::all();
        $autoritecontractantes = DB::table('autoritecontractantes')
            ->join('users','users.id','=','autoritecontractantes.id_user')
            ->join('pays','pays.id','=','autoritecontractantes.id_pays')
            ->leftjoin('categorieautorites','categorieautorites.id','=','autoritecontractantes.categorieautorite_id')
            ->select('autoritecontractantes.*', 'users.name','pays.nom_pays','categorieautorites.libelleCat')->orderby('autoritecontractantes.created_at','desc')
            ->get();

        return view('liste_autorite',compact('autoritecontractantes','pays','categories'));
        

    }
    
    //Fonction de recherche
    
    public function Rechercher()
    {
        
        $data = request()->validate([
            'recherche' => ['required'],
        ]);
        
        $pays = DB::table('pays')->orderby('nom_pays')->get();

        $autoritecontractantes = DB::table('autoritecontractantes')
            ->join('users','users.id','=','autoritecontractantes.id_user')
            ->join('pays','pays.id','=','autoritecontractantes.id_pays')
            ->select('autoritecontractantes.*', 'users.name','pays.nom_pays')->orderby('autoritecontractantes.created_at','desc')
            ->where('users.name','LIKE','%'.$data['recherche'].'%')
            ->paginate(200);

        return view('liste_autorite',compact('autoritecontractantes','pays'));
        
    }


    public function create()
    {
        
        
        $data = request()->validate([
            'name' => ['required','max:100','string','unique:users'],
            'pays' => ['required', 'numeric','gt:0'],
            'adresse' => ['nullable'],
            'categorie'=>['nullable'],
            'description' => ['nullable','max:254'],
        ]);
        

        // Condition d'enrégistrement

        $okcreat = DB::transaction(function() use($data)
            {

                if ($data['adresse'] == null) {

                    $newuser = DB::table('users')->insert([
                        'name' => $data['name'],
                        'type_user' => 2,
                        'created_by' => auth()->id(),
                        'created_at' => NOW(),
                        'updated_at' => NOW(),
                    ]);

                    $idop = DB::table('users')
                        ->where('name','=',$data['name'])
                        ->select('id')
                        ->get();

                    
                    if($data['description'] == ''){
                        
                        $adduser = DB::table('autoritecontractantes')->insert([
                        'id_user' => $idop[0]->id,
                        'id_pays' => $data['pays'],
                        'categorieautorite_id'=>$data['categorie'],
                        'created_by' => auth()->id(),
                        'created_at' => NOW(),
                        'updated_at' => NOW(),]);
                        
                    }else{
                        
                        $adduser = DB::table('autoritecontractantes')->insert([
                        'id_user' => $idop[0]->id,
                        'id_pays' => $data['pays'],
                        'categorieautorite_id'=>$data['categorie'],
                        'des_autorite' => $data['description'],
                        'created_by' => auth()->id(),
                        'created_at' => NOW(),
                        'updated_at' => NOW(),]);
                        
                    }

                    return $adduser;

                }else {

                    $newuser = DB::table('users')->insert([
                        'name' => $data['name'],
                        'type_user' => 2,
                        'created_by' => auth()->id(),
                        'created_at' => NOW(),
                        'updated_at' => NOW(),
                    ]);

                    $idop = DB::table('users')
                        ->where('name','=',$data['name'])
                        ->select('id')
                        ->get();
                        
                    if($data['description'] == ''){
                        
                        $adduser = DB::table('autoritecontractantes')->insert([
                        'id_user' => $idop[0]->id,
                        'id_pays' => $data['pays'],
                        'adresse' => $data['adresse'],
                        'categorieautorite_id'=>$data['categorie'],
                        'created_by' => auth()->id(),
                        'created_at' => NOW(),
                        'updated_at' => NOW(), ]);
                        
                    }else{
                        
                        $adduser = DB::table('autoritecontractantes')->insert([
                        'id_user' => $idop[0]->id,
                        'id_pays' => $data['pays'],
                        'adresse' => $data['adresse'],
                        'categorieautorite_id'=>$data['categorie'],
                        'created_by' => auth()->id(),
                        'created_at' => NOW(),
                        'updated_at' => NOW(), ]);
                        
                    }

                    return $adduser;
                }

            });

        // End Condition d'enrégistrement

        if ($okcreat) {

            return redirect(route('liste_autorite'))->with('add_ok', '');

        } else {

            dd('error');
        }

    }

    public function update($autorite)
    {
        $categories=Categorieautorite::all();
        $autoritecontractantes = DB::table('autoritecontractantes')
            ->join('users','users.id','=','autoritecontractantes.id_user')
            ->join('pays','pays.id','=','autoritecontractantes.id_pays')
            ->select('autoritecontractantes.*', 'users.name','pays.nom_pays')->orderby('autoritecontractantes.created_at','desc')
            ->paginate(30);

        // $updates = DB::table('autoritecontractantes')->where('id','=',$autorite)->limit(1)->get();
        
        $updates = DB::table('autoritecontractantes')
            ->join('users','users.id','=','autoritecontractantes.id_user')
            ->select('autoritecontractantes.*', 'users.name','users.email')
            ->where('autoritecontractantes.id','=',$autorite)->limit(1)->get();

        if($updates){

            $users = DB::table('users')->orderby('created_at','desc')->get();
            $pays = DB::table('pays')->orderby('nom_pays')->get();

            return view('update_autorite',compact('users','pays','updates','autoritecontractantes','categories'));

        }else{

            dd('fezrfezr');

            return redirect(route('liste_pays'));

        }
    }

    public function add_update($autorite)
    {

        $data = request()->validate([
            'name' => ['required','string'],
            'pays' => ['required', 'numeric','gt:0'],
            'adresse' => ['nullable'],
            'status' => ['nullable'],
            'categorie'=>['nullable'],
            'description' => ['required','max:254'],
        ]);

        $iduser = DB::table('autoritecontractantes')
            ->select('autoritecontractantes.id_user')
            ->where('autoritecontractantes.id','=',$autorite)->limit(1)->get();

        $iduser = $iduser[0]->id_user;

        $updateuser = DB::table('users')
                ->where('id', $iduser)
                ->update(['name' => $data['name']]);

        $update = DB::table('autoritecontractantes')
                ->where('id', $autorite)
                ->update(['id_pays' => $data['pays'],'categorieautorite_id'=>$data['categorie'],
                    'adresse' => $data['adresse'],'des_autorite' => $data['description']]);


        if ($update || $updateuser) {

            return redirect(route('liste_autorite'))->with('update_ok', '');

        } else {

            return redirect(route('get_update_autorite',$autorite))->with('update_no', '');
        }

        


    }

    public function delete($autorite)
    {

        $delete = DB::table('autoritecontractantes')->where('id', '=', $autorite)->delete();

        if ($delete) {

            return redirect(route('liste_autorite'))->with('delete_ok', '');

        } else {

            return redirect(route('liste_autorite'))->with('delete_no', '');
        }

    }
}
