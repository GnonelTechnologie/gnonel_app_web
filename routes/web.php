<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Categorieabonnement;
use App\Abonnement;
use App\Http\Controllers\CarouselController;
use App\Mail\NewAccountMail;
use App\Recommander;
//use App\Xlsxwriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request as FacadesRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test-mail', function () {
    $data = ['name' => 'Omar Farouk', 'link' => 'https://gnonel.com/complete-information'];

    Mail::to('komarf28@gmail.com')->send(new NewAccountMail($data));

    return "Email sent successfully!";
});

//news letter
Route::post('newsletter', function (Request $request) {

    $old = DB::table('newsletters')->where('email_n', $request->email_n)->get();
    $size = sizeof($old);
    if ($size == 0) {
        $adduser = DB::table('newsletters')->insert([
            'email_n' => $request->email_n,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);
        if ($adduser) {
            return redirect()->back()->with('flash_message_success', 'Abonnement effectué avec succès');
        } else {
            return redirect()->back()->with('flash_message_error', 'Erreur lors de l\'abonnement');
        }
    } else {
        return redirect()->back()->with('flash_message_error', 'Vous avez déjà souscrit');
    }
})->name('newsletter');



Route::get('reinitialisation', function () {
    return view('auth/recuperation');
})->name('reinitialisation');

Route::post('/sendEmailPass', 'UserController@sendEmailPass')->name('sendEmailPass');
Route::post('return-subscription', function (Request $request) {
    return redirect()->route('home');
})->name('return-subscription')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);;
Route::post('cancel-subscription', function (Request $request) {
    return redirect()->route('pricing');
})->name('cancel-subscription')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);;

/*
Route::get('/', function () {
    //auth()->logout();
    if (Auth()->check()) {
        return redirect(url('/acceuil/membre'));
    }
    $pays = DB::table('pays')->orderby('nom_pays', 'asc')->get();
    $categories = DB::table('categories')->orderby('nom_categorie', 'asc')->get();
    $autoritecontractantes = DB::table('users')
        ->join('autoritecontractantes', 'users.id', '=', 'autoritecontractantes.id_user')
        ->where('users.type_user', '=', 2)
        ->select('autoritecontractantes.id', 'users.name')->orderby('users.name', 'asc')
        ->get();

    $offres = DB::table('appeloffres')
        ->join('autoritecontractantes', 'autoritecontractantes.id', '=', 'appeloffres.id_autorite')
        ->join('users', 'users.id', '=', 'autoritecontractantes.id_user')
        ->join('categories', 'categories.id', '=', 'appeloffres.id_categorie')
        ->join('pays', 'pays.id', '=', 'autoritecontractantes.id_pays')
        ->where('appeloffres.status', '=', 1)
        ->select('appeloffres.*', 'pays.nom_pays', 'users.name', 'categories.nom_categorie')->orderby('appeloffres.created_at', 'desc')
        ->get();

    return view('welcome', compact('pays', 'categories', 'autoritecontractantes', 'offres'));
})->name('welcome');*/

Route::get('/', function () {
    //auth()->logout();
    if (Auth()->check()) {
        return redirect(url('/acceuil/membre'));
    }
    $pays = DB::table('pays')->orderby('nom_pays', 'asc')->get();
    $categories = DB::table('categories')->orderby('nom_categorie', 'asc')->get();
    $autoritecontractantes = DB::table('users')
        ->join('autoritecontractantes', 'users.id', '=', 'autoritecontractantes.id_user')
        ->where('users.type_user', '=', 2)
        ->select('autoritecontractantes.id', 'users.name')->orderby('users.name', 'asc')
        ->get();

    $offres = DB::table('appeloffres')
        ->join('autoritecontractantes', 'autoritecontractantes.id', '=', 'appeloffres.id_autorite')
        ->join('users', 'users.id', '=', 'autoritecontractantes.id_user')
        ->join('categories', 'categories.id', '=', 'appeloffres.id_categorie')
        ->join('pays', 'pays.id', '=', 'autoritecontractantes.id_pays')
        ->where('appeloffres.status', '=', 1)
        ->select('appeloffres.*', 'pays.nom_pays', 'users.name', 'categories.nom_categorie')->orderby('appeloffres.created_at', 'desc')
        ->get();

    return view('index', compact('pays', 'categories', 'autoritecontractantes', 'offres'));
})->name('index');

//route poste de la recherche

Route::get('/recherche-offreappel', 'RechercheController@rechercheoffre')->name('rechercheoffre');
Route::get('/search-offre/{id}', 'RechercheController@rechercheajax')->name('search');
//route du dashboard
Route::get('/Dashdoard', function () {
    echo ('rédiriger vers la vue de dashbord');
})->name('Dashdoard')->middleware('auth');

//liste recomm
Route::get('/liste_recommandation', function () {
    $recommandes = Recommander::join('souscriptions', 'souscriptions.idsouscription', '=', 'recommanders.souscription_id')
        ->where('exporte', false)->where('souscriptions.statut', 1)->orderByDesc('recommanders.created_at')->get();
    return view('liste_recom', compact('recommandes'));
})->name('liste_recom')->middleware('auth');

//EXPORT liste recomm
Route::get('/exporte', function () {
    require_once base_path('app/Xlsxwriter.class.php');
    // $recommandes=Recommander::where('exporte',false)->where('souscription_id','!=',null)->get();
    $recommandes = Recommander::join('souscriptions', 'souscriptions.idsouscription', '=', 'recommanders.souscription_id')
        ->join('users as u', 'u.id', '=', 'recommanders.user_id')
        ->join('users as us', 'us.id', '=', 'souscriptions.iduser')
        ->where('recommanders.exporte', false)
        ->whereNotNull('recommanders.souscription_id')
        ->select('recommanders.created_at', 'u.email', 'u.telephone', 'recommanders.lien', 'souscriptions.montant_finale_apaye', 'souscriptions.frais_bonus', 'us.email as email_r')
        ->orderByDesc('recommanders.created_at')
        ->get();

    //Recommander::where('exporte',false)->get();
    //dd($recommandes);
    $myadd = array("Date", "Email du recommandeur", "Numéro du  recommandeur", 'Lien de recommandation', 'Montant abonnement', 'Montant réduction', 'Email du recommandé');
    $ar = $recommandes->toArray();
    array_unshift($ar, $myadd);
    //dd();
    $data = $ar;

    $writer = new Xlsxwriter();
    $writer->writeSheet($data);
    $writer->writeToFile('assets/output.xlsx');
    DB::table('recommanders')
        ->where('exporte', false)
        ->where('souscription_id', '!=', null)
        ->update(['exporte' => true]);

    return response()->file(base_path('assets/output.xlsx'));
})->name('ex_liste_recom')->middleware('auth');


//route du statistique
Route::get('/statistique', function () {
    echo ('rédiriger vers la vue des statistiques');
})->name('statistique')->middleware('auth');



//route de création d'une offre
Route::get('/liste/model', 'ModelController@view')->name('liste_model')->middleware('auth');
Route::post('/liste/model', 'ModelController@create')->name('add_model')->middleware('auth');
Route::get('/modifier/{model}/model', 'ModelController@update')->name('get_update_model')->middleware('auth');
Route::post('/modifier/{model}/model', 'ModelController@add_update')->name('add_update_model')->middleware('auth');
Route::get('/Supprimer/{model}/model', 'ModelController@delete')->name('delete_model')->middleware('auth');

//route de création d'une autorité contractante
Route::get('/creer/autorite_contractante', 'AutoriteController@view_created')->name('create_autorite')->middleware('auth');
Route::post('/creer/autorite_contractante', 'AutoriteController@create')->name('add_autorite')->middleware('auth');

//route de création d'une autorité bon_de_commande
Route::get('/creer/bon_de_commande', 'BonController@view')->name('create_bon')->middleware('auth');
Route::post('/creer/bon_de_commande', 'BonController@create')->name('add_bon')->middleware('auth');

//route de création d'un opérateur économique
Route::get('/creer/opérateur', 'OperateurController@view_created')->name('create_operateur')->middleware('auth');
Route::post('/creer/opérateur', 'OperateurController@create')->name('add_operateur')->middleware('auth');

//route pour lister les offres enrégistrées
Route::get('/liste/offre', 'OffreController@view')->name('liste_offre')->middleware('auth');


Route::post('/Rechercher/opérateur', 'OperateurController@Rechercher')->name('rechercher_operateur')->middleware('auth');
Route::get('/Rechercher/opérateur', function () {

    return redirect(route('liste_operateur'));
})->name('redirect_liste_operateur');





Route::post('/Rechercher/Autorité', 'AutoriteController@Rechercher')->name('rechercher_autorite')->middleware('auth');
Route::get('/Rechercher/Autorité', function () {

    return redirect(route('liste_autorite'));
})->name('redirect_liste_autorite');





Route::get('/gestion/references', 'ReferenceController@view_reference')->name('view_reference')->middleware('auth');


//route Secteur d'activité



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cgu', function () {
    return view('landing.cgu');
});

Route::get('/privacy-policy', function () {
    return view('landing.privacy_policy');
});

Route::post('/home', function () {
    return redirect(Route('home'));
})->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
/*Route::get('/recherche-offre', function () {
    return redirect('/');
})->name('resultat');*/

// Route pour avoir plus de détais sur l'offre sélectionnée
Route::get('/Details/{idoffre}', 'RechercheController@details_offre')->name('Details');


// Route Ajax Récupérer les autorité contractante en fonction d'un pays

Route::get('/ajaxgetautorite', 'PaysController@ajaxgetautorite')->name('ajaxgetautorite');

// Route Ajax Récupérer les opérateurs en fonction d'un pays

Route::get('/ajaxgetoperateur', 'PaysController@ajaxgetoperateur')->name('ajaxgetoperateur');

//recupere l'operateur qui a o moin une reference technique
Route::get('/ajaxgetoperateurwithreference', 'PaysController@ajaxgetoperateurwithreference')->name('ajaxgetoperateurwithreference');
// Route Ajax Récupérer les opérateurs et les autorités en fonction d'un pays

Route::get('/ajaxgetoperateur_autorite', 'PaysController@ajaxgetoperateur_autorite')->name('ajaxgetoperateur_autorite');
// Route Ajax Récupérer les opérateurs et les jfe
Route::get('/ajaxgetoperateur_jfe', 'PaysController@ajaxgetoperateur_jfe')->name('ajaxgetoperateur_jfe');

//Route Abonnement

Route::get('/souscription', 'AbonnementController@choix_souscription')->name('choix_souscription');
Route::post('/souscription', 'AbonnementController@souscription')->name('souscription');

Route::get('/Détails/Abonnement/{id}', function ($id) {
    $abonnement = Abonnement::where('libelle', $id)->first();

    return view('details_abonnement_soumissionnaires', compact('abonnement'));
})->name('details_abonnement');

Route::get('/Détails/Abonnement/autorite', function () {

    return view('details_abonnement_autorite');
})->name('details_abonnement_autorite');

Route::get('/Détails/Abonnement/mixte', function () {

    return view('details_abonnement_mixte');
})->name('details_abonnement_mixte');

Route::get('/Souscription/Abonnement/{offre}', 'AbonnementController@creer_abonne')->name('creer_abonne');




Route::get('/autorite-contratante/operateur-details', function () {

    return view('views_reference_operateur');
})->name('ref_reference_operateur');

Route::get('/Details/Référence/XTTIRTO', function () {

    return view('views_details_reference');
})->name('details_reference');



Route::get('/offre-abonnements', function () {

    $pays = DB::table('pays')->orderby('nom_pays')->get();
    //$abonnements = DB::table('abonnement')->get();
    $categories = Categorieabonnement::all();
    return view('landing.pricing', compact('pays', 'categories'));
})->name('choix_abonnement');

Route::get('/pricing', 'FrontController@pricing')->name('pricing');

//Route::post('/offre-abonnements', 'UserController@create_user')->name('register_user');
Route::post('/pricing', 'UserController@create_user')->name('register_user');

//Gnonel test send PHP mail

Route::get('/sendmails', function () {

    //dd('route ok');

    $message = 'message test';

    $sendmail = mail('gybadane@gmail.com,avhoungbo@gmail.com', 'Gnonel - Diffusion', $message);
    dd($sendmail);
})->name('sendmails');

Route::get('/comment-ça-marche', function () {

    return view('details_all_abonnement');
})->name('details_all_abonnement');

// mode de passation
Route::resource('modepassations', 'ModeController')->middleware('auth');
Route::get('/Supprimer/{id}/mode', 'ModeController@delete')->name('delete_mode')->middleware('auth');

//caategorie autorité




Route::get('view/nos-service', 'FrontController@service')->name('nos_service');
Route::get('services/business', 'FrontController@service_business')->name('service-business');
Route::get('services/pro', 'FrontController@service_pro')->name('service-pro');
Route::get('services/mix', 'FrontController@service_mix')->name('service-mix');
Route::get('services/options', 'FrontController@service_options')->name('service-options');
Route::get('contact', 'FrontController@contact')->name('contact');

Route::get('view/annuler-abonnement/{id}', 'FrontController@annuler')->name('annuler_abonnement');

//
Route::get('view/getmodifpass', 'FrontController@getmodifpass')->name('modifpass')->middleware('auth');
Route::post('view/modifpass', 'FrontController@modifpass')->name('postmodifpass')->middleware('auth');

Route::get('ajaxbonnement/{libelle}', 'AbonnementController@ajaxbonnement')->name('ajaxbonnement');



Route::get('listspec', 'FrontController@listspec');


Route::post('filtrerspec', 'SpecController@filtrerspec')->name('filtrerspec');


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    //liste news letter

    Route::get('getnewsletter', function () {
        $news = DB::table('newsletters')->get();
        return view('liste_news', compact('news'));
    })->name('getnewsletter');


    //delete news letter

    Route::get('deletenewsletter/{id}', function ($id) {
        $delete = DB::table('newsletters')->where('id', '=', $id)->delete();
        return redirect()->route('getnewsletter')->with('delete_ok', '');
    })->name('deletenewsletter');


    Route::resource('carousel', 'CarouselController')->middleware('auth');




    Route::get('specification/createAdmin', 'SpecController@create')->name('specifications.createAdmin');

    Route::post('specifications/store', 'SpecController@store')->name('specifications.store_admin');

    Route::get('specification/indexAdmin', 'SpecController@indexAdmin')->name('specifications.indexAdmin');


    Route::get('specification/valider/{id}', 'SpecController@valider')->name('specifications.valider');

    Route::get('specification/rejeter/{id}', 'SpecController@rejeter')->name('specifications.rejeter');

    Route::get('specification/deleteAdmin/{id}', 'SpecController@deleteAdmin')->name('specifications.deleteAdmin');

    Route::resource('categorieautorites', 'CategorieautoriteController')->middleware('auth');
    Route::get('/Supprimer/{id}/categorieautorite', 'CategorieautoriteController@delete')->name('delete_catautorite');

    Route::resource('categorieabonnements', 'CategorieabonnementController')->middleware('auth');
    Route::get('/Supprimer/{id}/categorieabonnement', 'CategorieabonnementController@delete')->name('delete_catabonnement');


    Route::resource('abonnements', 'AbonnementController');
    Route::get('/Supprimer/{id}/abonnement', 'AbonnementController@delete')->name('delete_abonnement');
    Route::get('/secteur_activite', 'OffreController@viewsecteur_activite')->name('viewsecteur_activite')->middleware('auth');
    Route::post('/Creer/secteur_activite', 'OffreController@createsecteur_activite')->name('createsecteur_activite')->middleware('auth');
    Route::get('/modifier/{idsecteur_activite}/secteur_activite', 'OffreController@updatesecteur_activite')->name('updatesecteur_activite');
    Route::get('/Supprimer/{idsecteur_activite}/secteur_activite', 'OffreController@deletesecteur_activite')->name('deletesecteur_activite');

    //route de création d'une offre
    Route::get('/creer/offre', 'OffreController@view_created')->name('create_offre');
    Route::post('/creer/offre', 'OffreController@create')->name('add_offre');
    Route::get('/modifier/{offre}/offre', 'OffreController@update')->name('get_update_offre');
    Route::post('/modifier/{offre}/offre', 'OffreController@add_update')->name('add_update_offre');
    Route::get('/Supprimer/{offre}/offre', 'OffreController@delete')->name('delete_offre');
    Route::get('/activer/{offre}/offre', 'OffreController@activer_offre')->name('activer_offre');
    Route::get('/cloturer/{offre}/offre', 'OffreController@cloturer_offre')->name('cloturer_offre');

    Route::resource('admins', 'UserController')->middleware('auth');
    //route pour lister les pays enrégistrées

    Route::get('/liste/pays', 'PaysController@view')->name('liste_pays');
    Route::post('/liste/pays', 'PaysController@create')->name('add_pays');
    Route::get('/modifier/{idpays}/pays', 'PaysController@update')->name('get_update_pays');
    Route::post('/modifier/{idpays}/pays', 'PaysController@add_update')->name('add_update_pays');
    Route::get('/Supprimer/{idpays}/pays', 'PaysController@delete')->name('delete_pays');
    //route pour lister les opérateurs enrégistrées
    Route::get('/liste/opérateur', 'OperateurController@view')->name('liste_operateur');
    Route::get('/modifier/{operateur}/opérateur', 'OperateurController@update')->name('get_update_operateur');
    Route::post('/modifier/{operateur}/opérateur', 'OperateurController@add_update')->name('add_update_operateur');
    Route::get('/Supprimer/{operateur}/opérateur', 'OperateurController@delete')->name('delete_operateur');

    //route pour lister les catégorie enrégistrées

    Route::get('/liste/catégorie', 'CategorieController@view')->name('liste_categorie')->middleware('auth');
    Route::post('/liste/catégorie/creer', 'CategorieController@create')->name('add_categorie')->middleware('auth');
    Route::get('/modifier/{idcategorie}/catégorie', 'CategorieController@update')->name('get_update_categorie')->middleware('auth');
    Route::post('/modifier/{idcategorie}/catégorie', 'CategorieController@add_update')->name('add_update_categorie')->middleware('auth');
    Route::get('/Supprimer/{idcategorie}/catégorie', 'CategorieController@delete')->name('delete_categorie')->middleware('auth');



    //route Références

    Route::get('/create/référence', 'ReferenceController@view_create')->name('create_reference')->middleware('auth');
    Route::get('/liste/référence', 'ReferenceController@view')->name('liste_reference')->middleware('auth');
    Route::post('/create/référence', 'ReferenceController@create')->name('add_reference')->middleware('auth');
    Route::get('/valider/référence/{id}', 'ReferenceController@valider')->name('valider_reference')->middleware('auth');
    Route::get('/rejeter/référence/{id}', 'ReferenceController@rejeter')->name('rejeter_reference')->middleware('auth');
    Route::get('/delete/référence/{id}', 'ReferenceController@delete')->name('delete_reference')->middleware('auth');
    //route pour lister les utilisateurs enrégistrées
    Route::get('/liste/autorite_contractante', 'AutoriteController@view')->name('liste_autorite')->middleware('auth');
    Route::get('/modifier/{autorite}/autorité-contractante', 'AutoriteController@update')->name('get_update_autorite')->middleware('auth');
    Route::post('/modifier/{autorite}/autorité-contractante', 'AutoriteController@add_update')->name('add_update_autorite')->middleware('auth');
    Route::get('/Supprimer/{autorite}/autorité-contractante', 'AutoriteController@delete')->name('delete_autorite')->middleware('auth');
    //route pour lister les utilisateurs enrégistrées
    Route::get('/liste/utilisateur', 'UserController@view')->name('liste_utilisateur');
    //route pour lister les utilisateur dont les abonnement sont en cours
    Route::get('/liste/utilisateur/abonnees', 'UserController@viewabonne')->name('liste_utilisateur_abonne');
    Route::get('/modifier/{id}/reference', 'ReferenceController@update')->name('get_update_reference');
    Route::post('/modifier/{id}/reference', 'ReferenceController@add_update')->name('add_update_reference');
});



// Création d'opérateur ou d'autorité contractante
Route::post('view/enreg_operateur', 'FrontController@enregoperateur')->name('enreg_operateur');
Route::post('view/enreg_autorite', 'FrontController@enregautorite')->name('enreg_autorite');


Route::group(['middleware' => ['auth', 'role:user']], function () {
    # Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('recommanders', 'RecommanderController');
    Route::resource('basefournisseurs', 'BasefourController');
    Route::post('references/recherche', 'BasefourController@searchreference');
    Route::get('delete/basefournisseurs/{id}', 'BasefourController@delete');

    Route::resource('specifications', 'SpecController');
    Route::get('delete/specifications/{id}', 'SpecController@delete');
    Route::get('view/viewextraitmesref', 'FrontController@viewextraitmesref')->name('viewextraitmesref');
    Route::post('postextraitmesref', 'FrontController@postextraitmesref')->name('postextraitmesref');
    Route::get('postextraitmesref', function () {
        return redirect()->back();
    });
    Route::get('view/mes_references', 'FrontController@viewmesref')->name('viewmesref');

    Route::get('delete/mes_references/{id}', 'FrontController@deletemesref')->name('deletemesref');
    Route::get('edit/mes_references/{id}', 'FrontController@editmesref')->name('editmesref');
    Route::put('update/mes_references/{id}', 'FrontController@updatemesref')->name('updatemesref');
    Route::post('view/enreg_reference', 'FrontController@enregreference')->name('enreg_reference');
    Route::get('info/compte', 'FrontController@infocompte')->name('info_compte');
    Route::get('profile', 'FrontController@infocompte')->name('profile');
    Route::get('change-password', 'FrontController@infocompte')->name('change-password');
    Route::get('view/detailsreference/{reference}', 'FrontController@detailsreference')->name('detailsreference');
    Route::get('info/compteaut', 'FrontController@infocompteaut')->name('infocompteaut');
    Route::get('view/all_references/{id}', 'FrontController@viewallref')->name('viewallref');
    Route::get('view/selectoperateur', 'FrontController@selectoperateur')->name('selectoperateur');
    Route::get('view/selectoperateur', 'FrontController@selectoperateur')->name('selectoperateur');
    Route::get('/recherche-offre', 'RechercheController@recherche')->name('recherche');
    Route::get('listspecabonne', 'FrontController@listspecabonne')->name('listspecabonne');
    Route::get('my-souscription', 'HomeController@mySouscription')->name('my-souscription');
    Route::post('souscription/add-user', 'HomeController@addUserSouscription')->name('add_user_souscription');
    Route::get('souscription/delete-user/{id}', 'HomeController@deleteUserSouscription')->name('delete_user_souscription');
    ///page acceuil abonnes
    Route::get('/acceuil/membre', function () {
        $refsCount = DB::table('references')->where('operateur', '=', Auth::user()->ratache_operateur)->count();
        $basesCount = DB::table('basefours')->where('user_id', '=', Auth::user()->id)->count();
        $specsCount = DB::table('specs')->where('user_id', '=', Auth::user()->id)->count();
        return view('abonnes/welcome_abonne', compact('refsCount', 'basesCount', 'specsCount'));
    })->name('welcome_abonne');

    Route::get('/Souscription/valide/{souscription}', 'AbonnementController@valider_souscription')->name('valider_souscription');
});
