<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Recommander;

class RecommanderController extends Controller
{
    public function index()
    {

        $recoms = Recommander::where('user_id', Auth::user()->id)->get();
        return view('recommanders/index', compact('recoms'));
    }

    public function create()
    {
        return view('recommanders/create');
    }

    public function store()
    {

        $lastid = 0;
        $elem = DB::table('recommanders')->orderBy('id', 'desc')->first();
        if ($elem != null) {
            $lastid = $elem->id;
        }

        $recom = new Recommander;

        $recom->user_id = Auth::user()->id;
        $recom->code = '' . (Auth::user()->id) . '/' . ($lastid + 1);
        $cript = $recom->code;

        $recom->lien = "" . route('pricing') . "?affiliation=" . $cript;
        //$recom->date_expiration=$request->description;

        $recom->save();
        return response()->json([

            "status" => "success",

            "result" => $recom
        ]);
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

            return redirect(route('modepassations.index'))->withErrors($validator->errors());
        } else {
            $mode = Mode::find($id);
            $mode->libelle = $request->libelle;
            $mode->description = $request->description;
            $mode->save();
            return redirect()->route('modepassations.index')->with('update_ok', '');
        }
    }
}
