<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BonController extends Controller
{

    public function view()
    {
        $operateurs = DB::table('operateurs')
            ->join('users','users.id','=','operateurs.id_user')
            ->join('pays','pays.id','=','operateurs.id_pays')
            ->select('operateurs.*', 'users.name','pays.nom_pays')->orderby('operateurs.created_at','desc')
            ->get();

        $autoritecontractantes = DB::table('autoritecontractantes')
            ->join('users','users.id','=','autoritecontractantes.id_user')
            ->join('pays','pays.id','=','autoritecontractantes.id_pays')
            ->select('autoritecontractantes.*', 'users.name','pays.nom_pays')->orderby('autoritecontractantes.created_at','desc')
            ->get();
            
        return view('create_bon',compact('operateurs','autoritecontractantes'));
    }


    public function create()
    {
        $data = request()->validate([
            'operateur' => ['required'],
            'autorite' => ['required'],
            'libelle' => ['required'],
            'montant' => ['required', 'numeric','gt:0'],
            'image' => ['required', 'image'],
            'video' => ['required'],
        ]);

        $imagepath = request('image')->store('uploads', 'public');
        $videopath = request('video')->store('uploads', 'public');

        $add = DB::table('boncommandes')->insert([
            'id_operateur' => $data['operateur'],
            'id_autorite' => $data['autorite'], 
            'libelle_appel' => $data['libelle'],
            'montant' => $data['montant'],
            'lien_images' => $imagepath,
            'lien_video' => $videopath,
            'created_by' => auth()->id(),
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);

        if ($add) {

            return redirect(route('create_bon'));

        } else {

            dd('Le serveur ne repons reprendre ultérieurement');
        }


    }
}
