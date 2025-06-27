<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{



    public static function deletefile($remote_file)
    {

        $ftp_server = "ftp.gnonel.com";
        $ftp_username = "gnone1681928";
        $ftp_password = "K0um1tch@1981";
        // Connexion au serveur FTP
        $ftp_conn = ftp_connect($ftp_server);
        if (!$ftp_conn) {
            die("Impossible de se connecter au serveur FTP");
        }

        // Authentification avec le nom d'utilisateur et le mot de passe
        $ftp_login = ftp_login($ftp_conn, $ftp_username, $ftp_password);
        if (!$ftp_login) {
            die("Impossible de s'authentifier sur le serveur FTP");
        }

        // Tentative de suppression du fichier distant
        if (ftp_delete($ftp_conn, $remote_file)) {
            echo "Le fichier $remote_file a été supprimé avec succès";
        } else {
            echo "Erreur lors de la suppression du fichier $remote_file";
        }

        // Fermeture de la connexion FTP
        ftp_close($ftp_conn);
    }
}
