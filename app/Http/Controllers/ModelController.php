<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;



class ModelController extends Controller

{



    public function view()

    {
         User::admin(Auth::user());

        $models = DB::table('modeles')->orderby('created_at','desc')->paginate(20);



        return view('liste_model',compact('models'));

    }





    public function create()

    {
         User::admin(Auth::user());

        $data = request()->validate([

            'fichier' => ['required', 'mimes:pdf'],

            'libelle' => ['required','max:100'],

        ]);



        $fichierpath = request('fichier')->store('uploads', 'public');



        $add = DB::table('modeles')->insert([

            'libelle_modele' => $data['libelle'],

            'lien_download' =>  $fichierpath ,

            'created_by' => auth()->id(),

            'created_at' => NOW(),

            'updated_at' => NOW(),

        ]);



        if ($add) {



            return redirect(route('liste_model'));



        } else {



            dd('Le serveur ne repons reprendre ultérieurement');

        }





    }



    public function update($model)

    {

 User::admin(Auth::user());

        $updates = DB::table('modeles')->where('id','=',$model)->limit(1)->get();



        if($updates){



            $models = DB::table('modeles')->orderby('created_at','desc')->paginate(20);

    

            return view('update_model',compact('models','updates'));



        }else{



            dd('fezrfezr');



            return redirect(route('liste_model'));



        }

    }



    public function add_update($model)

    {
         User::admin(Auth::user());

        $data = request()->validate([

            'fichier' => ['required', 'mimes:pdf'],

            'libelle' => ['required','max:100'],

            'status' => ['required'],

        ]);



        $fichierpath = request('fichier')->store('uploads', 'public');

        

        $update = DB::table('modeles')

                ->where('id', $model)

                ->update(['libelle_modele' => $data['libelle'],'lien_download' => $fichierpath,'status' => $data['status']]);



        if ($update) {



            return redirect(route('liste_model'))->with('update_ok', '');



        } else {



            return redirect(route('get_update',$model))->with('update_no', '');

        }



        





    }



    public function delete($model)

    {
         User::admin(Auth::user());

        $delete = DB::table('modeles')->where('id', '=', $model)->delete();



        if ($delete) {



            return redirect(route('liste_model'))->with('delete_ok', '');



        } else {



            return redirect(route('get_update_model',$pays))->with('delete_no', '');

        }



    }





    

}

