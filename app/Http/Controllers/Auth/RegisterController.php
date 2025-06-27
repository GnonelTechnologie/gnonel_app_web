<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        DB::table('operateurs')->insert([
            'id_pays' => $data['paysop'],
            'des_operateur' => 'OE',
            'status' => 1,
            'raison_social' => $data['nomop'],
            'num_fiscal' => "000000000",
            'secteuractivite_id' => $data['secteur'],
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);

        $operateur = DB::table('operateurs')->where('raison_social', $data['nomop'])->first();

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'pays_id' => $data['paysop'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'ratache_operateur' => $operateur->id,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);

        return $user;
    }
}
