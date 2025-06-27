<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Categorieautorite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class CategorieautoriteController extends Controller
{
    public function index()
    {
        User::admin(Auth::user());
        $categories = Categorieautorite::all();
        return view('categorieautorites/index', compact('categories'));
    }

    public function store(Request $request)
    {
        User::admin(Auth::user());

        $validator = Validator::make(
            $request->all(),

            [

                'libelle' =>  'required',
                'description' =>  'required',

            ]
        );



        if ($validator->fails()) {

            return redirect(route('categorieautorites.index'))->withErrors($validator->errors());
        } else {

            $categorie = new Categorieautorite;

            $categorie->libelleCat = $request->libelle;

            $categorie->description = $request->description;

            $categorie->save();
            return redirect()->route('categorieautorites.index')->with('add_ok', '');
        }
    }

    public function edit($id)
    {
        User::admin(Auth::user());
        $categories = Categorieautorite::all();
        $categorie = Categorieautorite::find($id);
        return view('categorieautorites/index', compact('categorie', 'categories'));
    }

    public function update($id, Request $request)
    {
        User::admin(Auth::user());
        $validator = Validator::make(
            $request->all(),

            [

                'libelle' =>  'required',
                'description' =>  'required',

            ]
        );



        if ($validator->fails()) {

            return redirect(route('categorieautorites.index'))->withErrors($validator->errors());
        } else {
            $categorie = Categorieautorite::find($id);
            $categorie->libelleCat = $request->libelle;
            $categorie->description = $request->description;
            $categorie->save();
            return redirect()->route('categorieautorites.index')->with('update_ok', '');
        }
    }

    public function delete($id)
    {
        User::admin(Auth::user());
        $categorie = Categorieautorite::find($id);
        $categorie->delete();
        return redirect()->route('categorieautorites.index')->with('delete_ok', '');
    }
}
