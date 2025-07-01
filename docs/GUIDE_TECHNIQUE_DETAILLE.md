# Guide Technique Détaillé - Modifications Gnonel

## Introduction

Ce guide technique fournit les instructions précises pour reproduire chaque modification effectuée sur le système Gnonel. Il est destiné aux développeurs et administrateurs système qui souhaitent comprendre ou reproduire ces changements.

## Prérequis

- Laravel 7.x
- PHP 7.4 (recommandé pour la compatibilité)
- Base de données MySQL/PostgreSQL
- Composer pour la gestion des dépendances

## 1. Contrôle d'Accès aux Spécifications Techniques

### Étape 1 : Modification du Contrôleur Principal

**Fichier :** `app/Http/Controllers/FrontController.php`

**Méthode :** `listspec()`
```php
public function listspec()
{
    // Vitrine publique : seules les spécifications publiées par l'admin sont visibles
    $specs = Spec::where('specs.status', 1)
                ->join('users', 'users.id', '=', 'specs.user_id')
                ->where('users.role', 'admin')
                ->select('specs.*')
                ->paginate(12);
                
    $pays = DB::table('pays')->orderby('nom_pays')->get();
    $categories = DB::table('categories')->orderby('code_categorie', 'asc')->get();

    return view('spec', compact('specs', 'pays', 'categories'));
}
```

**Méthode :** `listspecabonne()`
```php
public function listspecabonne()
{
    $verif = User::verifabonnement(Auth::user());

    $specs = Spec::where('specs.status', 1);

    // Vérification stricte pour les non-abonnés
    if ($verif == null || $verif->date_fin < date('Y-m-d')) {
        // Seuls les utilisateurs non-abonnés peuvent voir les spécifications de l'admin
        if (Auth::user()->type_user == 3) {
            $specs = $specs->join('users', 'users.id', '=', 'specs.user_id')
                          ->where('users.role', 'admin')
                          ->where('specs.status', 1);
        } else {
            // Redirection pour les autres types d'utilisateurs non-abonnés
            session()->flash('message', 'Veuillez vous abonner pour accéder aux spécifications techniques.');
            return redirect(route('pricing'));
        }
    } else {
        // Utilisateurs abonnés : accès à toutes les spécifications publiées
        if ($verif->date_fin == null) {
            return redirect(route('home'));
        }
    }

    $specs = $specs->paginate(12);

    // ... reste du code inchangé
}
```

### Étape 2 : Modification du Contrôleur des Spécifications

**Fichier :** `app/Http/Controllers/SpecController.php`

**Méthode :** `filtrerspec()`
```php
public function filtrerspec(Request $request)
{
    $pays = '';
    $categorie = '';
    $recherche = '';
    $pays = $request->pays;
    $categorie = $request->categorie;
    $recherche = $request->recherche;

    // Base query : seules les spécifications publiées par l'admin avec statut 1
    $baseQuery = DB::table('specs')
        ->join('pays', 'pays.id', '=', 'specs.pays_id')
        ->join('categories', 'categories.id', '=', 'specs.categorie_id')
        ->join('users', 'users.id', '=', 'specs.user_id')
        ->where('specs.status', 1)
        ->where('users.role', 'admin')
        ->select('specs.*', 'categories.nom_categorie', 'pays.nom_pays');

    $resultat = [];
    
    if ($pays != '' && $categorie == '' && $recherche == '') {
        $resultat = $baseQuery->where('specs.pays_id', '=', $pays)->orderby('specs.libelle', 'asc')->get();
    } elseif ($pays == '' && $categorie != '' && $recherche == '') {
        $resultat = $baseQuery->where('specs.categorie_id', '=', $categorie)->orderby('specs.libelle', 'asc')->get();
    } elseif ($pays == '' && $categorie == '' && $recherche != '') {
        $resultat = $baseQuery->where('specs.libelle', 'like', '%' . $recherche . '%')->orderby('specs.libelle', 'asc')->get();
    } elseif ($pays != '' && $categorie != '' && $recherche == '') {
        $resultat = $baseQuery->where('specs.categorie_id', '=', $categorie)
                             ->where('specs.pays_id', '=', $pays)
                             ->orderby('specs.libelle', 'asc')->get();
    } elseif ($pays != '' && $categorie != '' && $recherche != '') {
        $resultat = $baseQuery->where('specs.categorie_id', '=', $categorie)
                             ->where('specs.pays_id', '=', $pays)
                             ->where('specs.libelle', 'like', '%' . $recherche . '%')
                             ->orderby('specs.libelle', 'asc')->get();
    } else {
        // Aucun filtre : retourner toutes les spécifications admin publiées
        $resultat = $baseQuery->orderby('specs.libelle', 'asc')->get();
    }

    return response()->json([
        "status" => "success",
        "donnes" => $resultat
    ]);
}
```

### Étape 3 : Création du Middleware de Sécurité

**Fichier :** `app/Http/Middleware/SpecificationAccessMiddleware.php`

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;

class SpecificationAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $verif = User::verifabonnement($user);

        // Si l'utilisateur n'a pas d'abonnement ou que l'abonnement est expiré
        if ($verif == null || $verif->date_fin < date('Y-m-d')) {
            // Seuls les utilisateurs type_user == 3 (non-abonnés) peuvent accéder aux spécifications admin
            if ($user->type_user == 3) {
                // Autoriser l'accès mais filtrer les spécifications côté contrôleur
                return $next($request);
            } else {
                // Rediriger vers la page d'abonnement pour les autres types d'utilisateurs
                session()->flash('message', 'Veuillez vous abonner pour accéder aux spécifications techniques.');
                return redirect()->route('pricing');
            }
        }

        // Utilisateurs abonnés : accès autorisé
        return $next($request);
    }
}
```

### Étape 4 : Enregistrement du Middleware

**Fichier :** `app/Http/Kernel.php`

Ajouter dans la section `$routeMiddleware` :
```php
'spec.access' => \App\Http\Middleware\SpecificationAccessMiddleware::class,
```

### Étape 5 : Application du Middleware aux Routes

**Fichier :** `routes/web.php`

Modifier les routes suivantes :
```php
Route::post('filtrerspec', 'SpecController@filtrerspec')->name('filtrerspec')->middleware('spec.access');
Route::get('listspecabonne', 'FrontController@listspecabonne')->name('listspecabonne')->middleware('spec.access');
```

## 2. Correction du Problème de Boîte de Dialogue

### Modification du Contrôleur Principal

**Fichier :** `app/Http/Controllers/FrontController.php`

**Méthode :** `detailsreference()`
```php
public function detailsreference($id)
{
    $verif = User::verifabonnement(Auth::user());
    
    // Vérifier que l'utilisateur connecté a un abonnement valide
    if ($verif == null || $verif->date_fin == null) {
        return redirect(route('home'));
    } elseif ($verif->date_fin < date('Y-m-d')) {
        session()->flash('message', sprintf('Veuillez vous réabonner votre abonnement etait expiré le ' . Carbon::parse($verif->date_fin)->format('d/m/Y')));
        return redirect(route('pricing'));
    }

    // Récupérer l'ID de l'opérateur qui a publié la référence
    $oper_id = DB::table('references')
        ->join('operateurs', 'operateurs.id', '=', 'references.operateur')
        ->where('references.idreference', $id)
        ->select('operateurs.id')
        ->first();
    
    if (!$oper_id) {
        session()->flash('message', 'Référence introuvable.');
        return redirect()->back();
    }

    // Récupérer l'utilisateur qui a publié la référence
    $user_ref = User::where('ratache_operateur', $oper_id->id)->first();

    // Vérifier que la référence existe et est publiée
    $reference = DB::table('references')
        ->where('references.idreference', '=', $id)
        ->where('references.status', '=', 1) // Seules les références publiées
        ->first();

    if (!$reference) {
        session()->flash('message', 'Référence introuvable ou non publiée.');
        return redirect()->back();
    }

    // Pour les opérateurs économiques abonnés, permettre l'accès aux détails
    // sans vérifier l'abonnement de l'utilisateur qui a publié la référence
    if (Auth::user()->type_user == 3 && $verif != null && $verif->date_fin >= date('Y-m-d')) {
        return view('detailsreference', compact('reference'));
    }

    // Pour les autres types d'utilisateurs, vérifier l'abonnement de l'utilisateur qui a publié
    if ($user_ref == null) {
        session()->flash('message', 'Utilisateur non trouvé.');
        return redirect()->back();
    }

    if ($user_ref->date_fin == null) {
        session()->flash('message', 'L\'utilisateur qui a publié cette référence n\'a pas d\'abonnement valide.');
        return redirect()->back();
    } elseif ($user_ref->date_fin < date('Y-m-d')) {
        session()->flash('message', 'L\'abonnement de l\'utilisateur qui a publié cette référence a expiré.');
        return redirect()->back();
    }

    return view('detailsreference', compact('reference'));
}
```

## 3. Modification des Pourcentages de Réduction

### Modification du Contrôleur des Recommandations

**Fichier :** `app/Http/Controllers/RecommanderController.php`

Rechercher et remplacer toutes les occurrences de pourcentages supérieurs à 5% par 5%.

### Script SQL de Mise à Jour

Exécuter dans la base de données :
```sql
UPDATE recommandations SET pourcentage_reduction = 5 WHERE pourcentage_reduction > 5;
```

## 4. Ajout de l'Autocomplétion

### Création du Contrôleur de Recherche

**Fichier :** `app/Http/Controllers/RechercheController.php`

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RechercheController extends Controller
{
    public function autocompleteOffres(Request $request)
    {
        $term = $request->get('term');
        
        $offres = DB::table('offres')
            ->where('status', 1)
            ->where('libelle_offre', 'LIKE', '%' . $term . '%')
            ->select('id', 'libelle_offre as value')
            ->limit(10)
            ->get();

        return response()->json($offres);
    }

    public function autocompleteOperateurs(Request $request)
    {
        $term = $request->get('term');
        
        $operateurs = DB::table('operateurs')
            ->where('raison_social', 'LIKE', '%' . $term . '%')
            ->select('id', 'raison_social as value')
            ->limit(10)
            ->get();

        return response()->json($operateurs);
    }

    public function autocompleteAutorites(Request $request)
    {
        $term = $request->get('term');
        
        $autorites = DB::table('autoritecontractantes')
            ->where('raison_social', 'LIKE', '%' . $term . '%')
            ->select('id', 'raison_social as value')
            ->limit(10)
            ->get();

        return response()->json($autorites);
    }

    public function autocompleteReferences(Request $request)
    {
        $term = $request->get('term');
        
        $references = DB::table('references')
            ->join('operateurs', 'operateurs.id', '=', 'references.operateur')
            ->join('autoritecontractantes', 'autoritecontractantes.id', '=', 'references.autorite_contractante')
            ->where('references.status', '=', 1)
            ->where(function($query) use ($term) {
                $query->where('references.libelle_marche', 'LIKE', '%' . $term . '%')
                      ->orWhere('operateurs.raison_social', 'LIKE', '%' . $term . '%')
                      ->orWhere('autoritecontractantes.raison_social', 'LIKE', '%' . $term . '%');
            })
            ->select('references.idreference as id', 'references.libelle_marche as value', 'operateurs.raison_social', 'autoritecontractantes.raison_social')
            ->limit(10)
            ->get();

        return response()->json($references);
    }
}
```

### Ajout des Routes

**Fichier :** `routes/web.php`

Ajouter à la fin du fichier :
```php
// Routes d'autocomplétion
Route::get('/autocomplete/offres', 'RechercheController@autocompleteOffres')->name('autocomplete.offres');
Route::get('/autocomplete/operateurs', 'RechercheController@autocompleteOperateurs')->name('autocomplete.operateurs');
Route::get('/autocomplete/autorites', 'RechercheController@autocompleteAutorites')->name('autocomplete.autorites');
Route::get('/autocomplete/references', 'RechercheController@autocompleteReferences')->name('autocomplete.references');
```

### Création du Fichier CSS

**Fichier :** `public/css/autocomplete.css`

```css
.ui-autocomplete {
    max-height: 200px;
    overflow-y: auto;
    overflow-x: hidden;
    border: 1px solid #ccc;
    background: #fff;
    z-index: 9999;
}

.ui-autocomplete .ui-menu-item {
    padding: 8px 12px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
}

.ui-autocomplete .ui-menu-item:hover {
    background-color: #f5f5f5;
}

.ui-autocomplete .ui-menu-item:last-child {
    border-bottom: none;
}
```

### Intégration JavaScript

**Fichier :** `resources/views/view_select_operateur.blade.php`

Ajouter dans la section script :
```javascript
// Autocomplétion pour les champs de recherche
$(document).ready(function() {
    $("#recherche").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('autocomplete.references') }}",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            $("#recherche").val(ui.item.value);
            return false;
        }
    }).autocomplete("instance")._renderItem = function(ul, item) {
        return $("<li>")
            .append("<div><strong>" + item.value + "</strong><br><small>Opérateur: " + item.raison_social + "</small></div>")
            .appendTo(ul);
    };
});
```

## 5. Gestion d'Équipe, Switch d'Espace et Références/Spécifications liées à l'équipe

### Fonctionnalité

- Chaque utilisateur peut créer ou rejoindre une ou plusieurs équipes.
- Un menu permet de basculer dynamiquement entre l'espace personnel et les équipes auxquelles il appartient (affichage dans le menu utilisateur, badge d'équipe active).
- Lorsqu'une équipe est active, toutes les références et spécifications créées ou consultées sont liées à cette équipe (champ `team_id`).
- Si aucune équipe n'est active, les actions concernent l'espace personnel (champ `team_id` à `null`).

### Implémentation technique

#### 1. Menu utilisateur (layout)
- **Fichier :** `resources/views/layouts/appwelcom.blade.php`
- **Ajout :** Dropdown sous le nom de l'utilisateur listant toutes ses équipes et l'espace personnel. Le badge indique l'espace actif.

#### 2. Contrôleurs de Références et Spécifications
- **Fichiers :**
  - `app/Http/Controllers/ReferenceController.php`
  - `app/Http/Controllers/SpecController.php`
- **Logique :**
  - À la création/édition, le champ `team_id` est renseigné avec l'équipe active (session `active_team_id`).
  - À l'affichage, seules les références/spécifications de l'équipe active sont listées. Si aucune équipe n'est active, on affiche celles de l'utilisateur.

#### 3. Modèle Team
- **Fichier :** `app/Team.php`
- **Relations :** owner, member, references, specifications
- **Méthodes utilitaires :** isMember, isOwner, isAdmin, getUserTeams

#### 4. Routes
- **Fichier :** `routes/web.php`
- **Ajout :** Routes pour la gestion d'équipe, le switch d'espace, la configuration de compte temporaire, etc.

#### 5. Vues
- **Fichiers :**
  - `resources/views/teams/index.blade.php`
  - `resources/views/teams/create.blade.php`
  - `resources/views/teams/show.blade.php`
  - `resources/views/teams/configure-account.blade.php`
- **Contenu :** Gestion complète des équipes, invitation, notification, configuration de compte temporaire.

### Points d'attention
- Le menu d'équipe est visible uniquement pour les utilisateurs connectés.
- Les droits d'accès sont vérifiés à chaque action (appartenance à l'équipe, rôle owner/admin).
- Les mails d'invitation et de notification sont envoyés automatiquement selon le contexte.

### Exemple d'utilisation
- Un utilisateur crée une équipe et invite un membre (par email).
- Le membre reçoit un mail, configure son compte si besoin, et accède à l'équipe.
- En changeant d'équipe via le menu, toutes les références et spécifications affichées/éditées concernent l'équipe sélectionnée.
- L'utilisateur peut revenir à l'espace personnel à tout moment.

## 6. Tests et Validation

### Test du Contrôle d'Accès aux Spécifications

1. Se connecter avec un utilisateur non-abonné
2. Accéder à la vitrine des spécifications
3. Vérifier que seules les spécifications admin sont visibles

### Test de la Correction des Boîtes de Dialogue

1. Se connecter avec un opérateur économique abonné
2. Accéder aux détails d'une référence technique
3. Vérifier qu'aucune boîte de dialogue ne s'affiche

### Test de l'Autocomplétion

1. Aller sur la page de recherche
2. Taper dans le champ de recherche
3. Vérifier que les suggestions apparaissent

## 7. Déploiement

### Étapes de Déploiement

1. **Sauvegarde de la base de données**
```bash
mysqldump -u username -p database_name > backup_before_changes.sql
```

2. **Mise à jour des fichiers**
- Copier tous les fichiers modifiés
- Vérifier les permissions

3. **Nettoyage du cache**
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

4. **Test en production**
- Tester avec un utilisateur de test
- Vérifier toutes les fonctionnalités modifiées

### Rollback en Cas de Problème

1. **Restaurer la base de données**
```bash
mysql -u username -p database_name < backup_before_changes.sql
```

2. **Restaurer les fichiers**
- Remplacer les fichiers modifiés par les versions précédentes

3. **Nettoyer le cache**
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

## Conclusion

Ce guide technique détaillé fournit toutes les instructions nécessaires pour reproduire les modifications effectuées sur le système Gnonel. Chaque étape est documentée avec précision pour permettre une implémentation réussie.

## Support

En cas de problème lors de l'implémentation, vérifiez :
- Les permissions des fichiers
- La configuration de la base de données
- Les logs d'erreur Laravel (`storage/logs/laravel.log`)
- La compatibilité PHP/Laravel 