<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Categorieabonnement;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class CategorieabonnementController extends Controller
{
	public function index()
	{
         User::admin(Auth::user());
		$categories=Categorieabonnement::all();
		return view('categorieabonnes/index',compact('categories'));
	}

	public function store(Request $request)
	{
		 User::admin(Auth::user());

        $validator = Validator::make($request->all(),

            [

                'libelle' =>  'required',
                'description' =>  'required',

            ]);



        if ($validator->fails()) {

            return redirect(route('categorieabonnements.index'))->withErrors($validator->errors());

        }

        else{

            $categorie=new Categorieabonnement;

            $categorie->libelle=$request->libelle;

            $categorie->description=$request->description;

            $categorie->save();
            return redirect()->route('categorieabonnements.index')->with('add_ok', '');

        }


}

public function edit($id)
{
     User::admin(Auth::user());
	$categories=Categorieabonnement::all();
	$categorie=Categorieabonnement::find($id);
	return view('categorieabonnes/index',compact('categorie','categories'));
}

public function update($id,Request $request)
{
     User::admin(Auth::user());
	   $validator = Validator::make($request->all(),

            [

                'libelle' =>  'required',
                'description' =>  'required',

            ]);



        if ($validator->fails()) {

            return redirect(route('categorieabonnements.index'))->withErrors($validator->errors());

        }

        else{
	$categorie=Categorieabonnement::find($id);
	$categorie->libelle=$request->libelle;
	$categorie->description=$request->description;
    $categorie->save();
	return redirect()->route('categorieabonnements.index')->with('update_ok', '');
}
}

public function delete($id)
{
     User::admin(Auth::user());
	$categorie=Categorieabonnement::find($id);
	$categorie->delete();
	return redirect()->route('categorieabonnements.index')->with('delete_ok', '');
}

}