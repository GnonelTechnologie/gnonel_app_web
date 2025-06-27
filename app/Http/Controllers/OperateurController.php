<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class OperateurController extends Controller
{

    public function view_created()
    {
         User::admin(Auth::user());
        //$users = DB::table('users')->orderby('created_at','desc')->get();
        $pays = DB::table('pays')->orderby('nom_pays')->get();
        $secteur_activites = DB::table('secteuractivite')
            ->select('secteuractivite.*')
            ->orderby('libellesecteuractivite')
            ->get();
        return view('create_operateur',compact('pays','secteur_activites'));
    }

    public function view()
    {
         User::admin(Auth::user());
        $secteur_activites = DB::table('secteuractivite')
            ->select('secteuractivite.*')
            ->orderby('libellesecteuractivite')
            ->get();
       // $users = DB::table('users')->orderby('created_at','desc')->get();
        $pays = DB::table('pays')->orderby('nom_pays')->get();

        $operateurs = DB::table('operateurs')
           ->leftjoin('secteuractivite','secteuractivite.idsecteuractivite','=','operateurs.secteuractivite_id')
            ->join('pays','pays.id','=','operateurs.id_pays')
            ->select('operateurs.*', 'secteuractivite.libellesecteuractivite','pays.nom_pays')->orderby('operateurs.id','DESC')
            ->paginate(200);
            

        return view('liste_operateur',compact('operateurs','pays','secteur_activites'));
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
       

         User::admin(Auth::user());
        $data = request()->validate([
            'name' => ['required','max:100','string'],
            'mail' => ['nullable','email','unique:operateurs'],
            'pays' => ['required', 'numeric','gt:0'],
            'num_fiscal' => ['nullable','max:100'],
            'description' => ['required','max:254'],
            'secteur'=>['nullable'],
            'type'=>['nullable'],
        ]);
        
        $indicatif=DB::table('pays')->where('id',$data['pays'])->first()->indicatif;
        $lastid=DB::table('operateurs')->orderby('id','desc')->first()->id +1;
        $gnonel=$indicatif."1".str_pad($lastid,7,"0",STR_PAD_LEFT);

                    $adduser = DB::table('operateurs')->insert([
                        'raison_social' => $data['name'],
                        'id_pays' => $data['pays'],
                        'des_operateur' => $data['description'],
                        'secteuractivite_id'=>$data['secteur'],
                        'mail'=>$data['mail'],
                        'jfe'=>$data['type'],
                        'gnonelid'=>$gnonel,
                        'num_fiscal' => $data['num_fiscal'],
                        'created_by' => auth()->id(),
                        'created_at' => NOW(),
                        'updated_at' => NOW(),]);
                 
        if ($adduser) {

            return redirect(route('liste_operateur'))->with('add_ok', '');

        } else {

            dd('error');
        }


    }

    public function update($operateur)
    {
 User::admin(Auth::user());
        $updates = DB::table('operateurs')
            ->leftjoin('secteuractivite','secteuractivite.idsecteuractivite','=','operateurs.secteuractivite_id')
            ->select('operateurs.*')
            ->where('operateurs.id','=',$operateur)->limit(1)->get();
         
 $secteur_activites = DB::table('secteuractivite')
            ->select('secteuractivite.*')
            ->orderby('libellesecteuractivite')
            ->get();
        $operateurs = DB::table('operateurs')
            ->join('pays','pays.id','=','operateurs.id_pays')
            ->select('operateurs.*', 'pays.nom_pays')->orderby('operateurs.created_at','desc')
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
         User::admin(Auth::user());

        $data = request()->validate([
            'name' => ['required','string'],
            'mail' => ['nullable','email'],
            'pays' => ['required', 'numeric','gt:0'],
            'num_fiscal' => ['required','max:100'],
            'description' => ['required','max:254'],
            'secteur'=>['required'],
             'type'=>['nullable'],
        ]);

        $update = DB::table('operateurs')
            ->where('id', $operateur)
            ->update(['id_pays' => $data['pays'],'raison_social' => $data['name'],'secteuractivite_id'=>$data['secteur'],'num_fiscal' => $data['num_fiscal'],'des_operateur' => $data['description'],'mail'=>$data['mail'],'jfe'=>$data['type']]);

    
        if ($update) {

            return redirect(route('liste_operateur'))->with('update_ok', '');

        } else {

            return redirect(route('liste_operateur'))->with('update_no', '');
        }

        


    }

    public function delete($operateur)
    {
         User::admin(Auth::user());
        $delete = DB::table('operateurs')->where('id', '=', $operateur)->delete();

        if ($delete) {

            return redirect(route('liste_operateur'))->with('delete_ok', '');

        } else {

            return redirect(route('liste_operateur',$operateur))->with('delete_no', '');
        }

    }

}
