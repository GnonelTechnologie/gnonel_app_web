<?php

use App\Slider;
use Illuminate\Support\Facades\DB;



if (!function_exists('generateRandomInteger')) {
    /**
     * Generates a random integer with a given length
     * @param int $length The length of the integer to generate
     * @return string A random integer of the given length
     */
    function generateRandomInteger($length = 10)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('getMonthName')) {
    /**
     * Gets the name of the month given by its number.
     * @param int $monthOfYear The number of the month to get the name of.
     * @return string The name of the month, or "Janvier" if the month is not valid.
     */
    function getMonthName($monthOfYear)
    {
        $arrayMonth = array(
            1 => "Janvier",
            2 => "Février",
            3 => "Mars",
            4 => "Avril",
            5 => "Mai",
            6 => "Juin",
            7 => "Juillet",
            8 => "Aôut",
            9 => "Septembre",
            10 => "Octobre",
            11 => "Novembre",
            12 => "Décembre"
        );
        $month = ($monthOfYear >= 1 && $monthOfYear <= 12) ?  $arrayMonth[$monthOfYear] : 'Janvier';
        return $month;
    }
}

if (!function_exists('getAllPays')) {
    /**
     * Gets all countries from the database.
     * @return Illuminate\Support\Collection A collection of all countries from the database.
     */
    function getAllPays()
    {
        $pays = DB::table('pays')->orderby('nom_pays')->get();

        return $pays;
    }
}

if (!function_exists('getSecteurActivites')) {
    /**
     * Gets all sector activities from the database.
     * @return Illuminate\Support\Collection A collection of all sector activities from the database.
     */
    function getSecteurActivites()
    {
        $secteur_activites = DB::table('secteuractivite')->get();

        return $secteur_activites;
    }
}

if (!function_exists('getCarouselSliders')) {
    /**
     * Gets all enabled sliders from the database.
     * @return Illuminate\Support\Collection A collection of all enabled sliders from the database.
     */
    function getCarouselSliders()
    {
        $sliders = Slider::where(['status' => 1])->get();

        return $sliders;
    }
}


if (!function_exists('uploadCarouselFile')) {
    /**
     * Upload a file to the public/images/carousel directory, and return the URL
     * to the uploaded file. If the environment is not "local", the file is
     * uploaded to /var/www/gnonel.com/htdocs/images/carousel instead.
     * @param Illuminate\Http\UploadedFile $file The file to upload.
     * @return string The URL to the uploaded file, or null if the file was null.
     */
    function uploadCarouselFile($file)
    {
        if ($file != null) {
            $string = "";
            $chaine = "abcdefghijklmnpqrstuvwxy";
            srand((float)microtime() * 1000000);
            for ($i = 0; $i < 5; $i++) {
                $string .= $chaine[rand() % strlen($chaine)];
            }
            $ex = $file->getClientOriginalExtension();
            $m = 'slide' . '' . Date('hms') . $string . '.' . $ex;
            $file->move(config("app.env") == "local" ?  public_path('images/carousel') : "/var/www/gnonel.com/htdocs/images/carousel", $m);
            return "/images/carousel/" . $m;
        } else {
            return null;
        }
    }
}
