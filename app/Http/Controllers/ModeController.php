<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class ModeController extends Controller
{
    public function index()
    {
        User::admin(Auth::user());
        $modes = Mode::all();
        return view('mode/index', compact('modes'));
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

            return redirect(route('modepassations.index'))->withErrors($validator->errors());
        } else {

            $mode = new Mode;

            $mode->libelle = $request->libelle;

            $mode->description = $request->description;

            $mode->save();
            return redirect()->route('modepassations.index')->with('add_ok', '');
        }
    }

    public function edit($id)
    {
        User::admin(Auth::user());
        $modes = Mode::all();
        $mode = Mode::find($id);
        return view('mode/index', compact('mode', 'modes'));
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

    public function delete($id)
    {
        User::admin(Auth::user());
        $mode = Mode::find($id);
        $mode->delete();
        return redirect()->route('modepassations.index')->with('delete_ok', '');
    }
}
