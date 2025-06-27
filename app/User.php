<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'pays_id',
        'pack_user_id',
        'type_user',
        'actif',
        'status',
        'role',
        'pays_id',
        'ratache_operateur',
        'ratache_autorite',
        'prenom'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function admin($user)
    {
        if ($user->type_user != 0) {
            dd("vous n'êtes pas autorisé veuillez contacter l'administrateur");
        }
    }
    public static function autorite($user)
    {
        if ($user->type_user != 5) {
            dd("vous n'êtes pas autorisé veuillez contacter l'administrateur");
        }
    }
    public static function operateur($user)
    {
        if ($user->type_user != 4) {
            dd("vous n'êtes pas autorisé veuillez contacter l'administrateur");
        }
    }
    public static function verifabonnement($user)
    {
        $souscription = DB::table('souscriptions')->where('iduser', '=', $user->id)
            ->join('abonnement', 'abonnement.id', '=', 'souscriptions.idabonnement')
            ->orderBy('souscriptions.idsouscription', 'DESC')
            ->first();
        if ($souscription == null) {
            $souscription = DB::table('souscriptions')->where('iduser', '=', $user->pack_user_id)
                ->join('abonnement', 'abonnement.id', '=', 'souscriptions.idabonnement')
                ->orderBy('souscriptions.idsouscription', 'DESC')
                ->first();
        }

        return $souscription;
    }

    public function genererMotDePasse($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public static function showUploadFile($file)
    {
        if ($file != null) {
            $string = "";
            $chaine = "abcdefghijklmnpqrstuvwxy";
            srand((float)microtime() * 1000000);
            for ($i = 0; $i < 5; $i++) {
                $string .= $chaine[rand() % strlen($chaine)];
            }
            $ex = $file->getClientOriginalExtension();
            $m = 'spec' . '' . Date('hms') . $string . '.' . $ex;
            // Storage::put('public/uploads/'.$m,file_get_contents($file->getRealPath()));
            $file->move(public_path('images/uploads'), $m);
            return $m;
        } else {
            return null;
        }
    }

    public static function imprimer($html, $table)
    {
        require_once('tcpdf/tcpdf.php');

        // Create new PDF document
        $pdf = new \TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->setPrintHeader(false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('gnonel');
        $pdf->SetTitle('gnonel');
        $pdf->SetSubject('gnonel');
        $pdf->SetKeywords('Keywords');

        // Add a page
        $pdf->AddPage();

        // Set some content to be added to the PDF
        // Write the HTML content to the PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        //
        $pdf->writeHTML($table, true, false, true, false, '');

        // Close and output PDF document
        $pdf->Output('gnonel.pdf', 'I');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Vérifier si l'utilisateur est un utilisateur standard
    public function isUser()
    {
        return $this->role === 'user';
    }


    public static function retrunpays($user)
    {
        $reponse = null;
        if ($user->ratache_operateur != null) {
            $reponse = DB::table('users')
                ->where('users.id', '=', $user->id)
                ->join('operateurs', 'operateurs.id', '=', 'users.ratache_operateur')
                ->join('pays', 'pays.id', '=', 'operateurs.id_pays')
                ->select('pays.*')->first()->id;
        }
        if ($user->ratache_autorite != null) {

            $reponse = DB::table('users')
                ->where('users.id', '=', $user->id)
                ->join('autoritecontractantes', 'autoritecontractantes.id', '=', 'users.ratache_autorite')
                ->join('pays', 'pays.id', '=', 'autoritecontractantes.id_pays')
                ->select('pays.*')->first()->id;
        }
        return $reponse;
    }

    public static function genereId()
    {
        $references = DB::table('references')->orderby('references.created_at', 'desc')->first()->idreference + 1;
        return "" . date('ymd') . "" . str_pad($references, 7, "0", STR_PAD_LEFT);
    }
}
