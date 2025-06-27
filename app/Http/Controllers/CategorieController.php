<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class CategorieController extends Controller
{

    public function view()
    {
         User::admin(Auth::user());
        $categories = DB::table('categories')->orderby('code_categorie','asc')->paginate(50);
        
        return view('liste_categorie',compact('categories'));
    }


    public function create()
    {
         User::admin(Auth::user());
        $data = request()->validate([
            'code' => ['required','max:5'],
            'nom' => ['required','max:100'],
            'status' => ['required'],
        ]);

        $add = DB::table('categories')->insert([
            'code_categorie' => $data['code'],
            'nom_categorie' => $data['nom'],
            'status' => $data['status'],
            'created_by' => auth()->id(),
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);

        if ($add) {

            return redirect(route('liste_categorie'));

        } else {

            dd('Le serveur ne repons reprendre ultérieurement');
        }


    }

    

    public function update($categorie)
    {
         User::admin(Auth::user());
        $updates = DB::table('categories')->where('id','=',$categorie)->limit(1)->get();

        if($updates){

            $categories = DB::table('categories')->orderby('code_categorie','asc')->paginate(20);
    
            return view('update_categorie',compact('categories','updates'));

        }else{

            dd('fezrfezr');

            return redirect(route('liste_categorie'));

        }
    }

    public function add_update($categorie)
    {
         User::admin(Auth::user());

        $data = request()->validate([
            'code' => ['required','max:3'],
            'nom' => ['required','max:80'],
            'status' => ['required'],
        ]);
        
        $update = DB::table('categories')
                ->where('id', $categorie)
                ->update(['nom_categorie' => $data['nom'],'code_categorie' => $data['code'],'status' => $data['status']]);

        if ($update) {

            return redirect(route('liste_categorie'))->with('update_ok', '');

        } else {

            return redirect(route('get_update_categorie',$categorie))->with('update_no', '');
        }

        


    }

    public function delete($categorie)
    {
         User::admin(Auth::user());
        $delete = DB::table('categories')->where('id', '=', $categorie)->delete();

        if ($delete) {

            return redirect(route('liste_categorie'))->with('delete_ok', '');

        } else {

            return redirect(route('get_update_categorie',$categorie))->with('delete_no', '');
        }

    }


}
