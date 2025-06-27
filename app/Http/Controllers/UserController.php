<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    // GESTION DE L'utilisateur qui s'abonne

    public function create_user()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function view()
    {
        User::admin(Auth::user());
        $users = DB::table('users')
            ->where('type_user', '!=', 0)
            ->orderby('created_at', 'desc')->get();
        return view('internautes/liste_utilisateur', compact('users'));
    }
    public function viewabonne()
    {
        User::admin(Auth::user());
        $users = DB::table('users')
            ->join('souscriptions', 'souscriptions.iduser', '=', 'users.id')
            ->where('type_user', '!=', 0)
            ->where('date_fin', '>', date('Y-m-d'))
            ->select('souscriptions.*', 'users.name', 'users.id', 'users.prenom', 'users.email')
            ->orderby('souscriptions.created_at', 'desc')->get();
        return view('internautes/liste_utilisateur_abonne', compact('users'));
    }


    public function create()
    {
        User::admin(Auth::user());
        return view('admins/create');
    }

    public function store(Request $request)
    {
        User::admin(Auth::user());
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            $adm = new User;
            $adm->email = $request->email;
            $adm->password = Hash::make($request->password);
            $adm->type_user = 0;
            $adm->role = 'admin';
            $adm->save();
            session()->flash('message', sprintf('Enregistrer avec succès'));
            return redirect()->route('admins.index');
        } else {
            session()->flash('error', sprintf("Cet email n'est pas disponible"));
            return redirect()->route('admins.index');
        }
    }

    public function edit($id)
    {
        User::admin(Auth::user());
        $adm = User::find($id);
        return view('admins/edit')->with('adm', $adm);
    }

    public function update($id, Request $request)
    {
        User::admin(Auth::user());
        $adms = User::find($id);
        //$adms->email=$request->email;
        if ($request->password != null) {
            $adms->password = Hash::make($request->password);
        }
        // $adms->admin=$request->admin;
        $adms->save();
        session()->flash('message', sprintf('modifier avec succès'));
        return redirect()->route('admins.index');
    }
    public function index()
    {
        User::admin(Auth::user());
        $us = User::where('type_user', '=', 0)->get();
        return view('admins/index')->with('us', $us);
    }
    public function destroy($id)
    {
        User::admin(Auth::user());
        $user = User::find($id);
        if (!empty($user)) {
            $user->delete();
            session()->flash('message', sprintf('Supprimer avec succes'));
        }
        return redirect()->route('admins.index');
    }

    public function sendEmailPass(Request $request)
    {


        $user = User::where('email', $request->email)->first();

        if ($user) {

            $n = 10;

            $u = new User();
            $pass = $u->genererMotDePasse($n);

            $from = "contact@gnonel.com";
            $to = $request->email;
            $subject = "gnonel Mot de passe par defaut";
            $message = "
        <html>
        <head>
            <title>Nouveau Mot de Passe par defaut</title>
        </head>
        <body>
            <p>Bonjour Cher(e) Client(e) , votre nouveau mot de passe par defaut est " . $pass . " . Veuillez le modifier apres votre connexion </p>
        </body>
        </html>
        ";
            // The content-type header must be set when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From:" . $from;
            $m = mail($to, $subject, $message, $headers);

            if ($m == true) {

                $user->password = Hash::make($pass);
                $user->save();

                return redirect(route('login'))->with('email_ok', '');
                //return response()->json(["status"=>"success","message"=>"succes envoi mot de passe"]);

            } else {
                return redirect(route('login'))->with('email_nok', '');
                //return response()->json(["status"=>" error","message"=>"echec envoi mot de passe"]);
            }
        } else {

            return response()->json(["status" => "error", "message" => "utilisateur introuvable"]);
        }
    }
}
