# Contrôle d'Accès aux Spécifications Techniques

## 🎯 Objectif

Assurer que **seules les spécifications publiées par le compte admin** sont accessibles aux utilisateurs non-abonnés dans la vitrine des spécifications.

## 🔒 Règles d'Accès

### Pour les Utilisateurs Non-Abonnés (`type_user == 3`)
- ✅ **Accès autorisé** aux spécifications publiées par l'admin (statut = 1)
- ❌ **Accès refusé** aux spécifications publiées par d'autres utilisateurs
- ❌ **Accès refusé** aux spécifications en attente (statut = 0)
- ❌ **Accès refusé** aux spécifications rejetées (statut = 2)

### Pour les Utilisateurs Abonnés
- ✅ **Accès complet** à toutes les spécifications publiées (statut = 1)
- ❌ **Accès refusé** aux spécifications en attente ou rejetées

### Pour les Autres Types d'Utilisateurs Non-Abonnés
- ❌ **Redirection** vers la page d'abonnement

## 🔧 Modifications Apportées

### 1. FrontController@listspecabonne()
```php
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
}
```

### 2. FrontController@listspec()
```php
// Vitrine publique : seules les spécifications publiées par l'admin sont visibles
$specs = Spec::where('specs.status', 1)
            ->join('users', 'users.id', '=', 'specs.user_id')
            ->where('users.role', 'admin')
            ->select('specs.*')
            ->paginate(12);
```

### 3. SpecController@filtrerspec()
```php
// Base query : seules les spécifications publiées par l'admin avec statut 1
$baseQuery = DB::table('specs')
    ->join('pays', 'pays.id', '=', 'specs.pays_id')
    ->join('categories', 'categories.id', '=', 'specs.categorie_id')
    ->join('users', 'users.id', '=', 'specs.user_id')
    ->where('specs.status', 1)
    ->where('users.role', 'admin')
    ->select('specs.*', 'categories.nom_categorie', 'pays.nom_pays');
```

### 4. Middleware SpecificationAccessMiddleware
Nouveau middleware pour contrôler l'accès aux routes des spécifications :
- Vérifie le statut d'abonnement
- Autorise l'accès aux non-abonnés (`type_user == 3`)
- Redirige les autres utilisateurs non-abonnés vers la page d'abonnement

## 🛡️ Sécurité Renforcée

### Middleware Appliqué
- `Route::get('listspecabonne', ...)->middleware('spec.access')`
- `Route::post('filtrerspec', ...)->middleware('spec.access')`

### Filtrage au Niveau Base de Données
- Jointure avec la table `users` pour vérifier le rôle
- Filtrage par `users.role = 'admin'`
- Filtrage par `specs.status = 1`

## 📊 Test et Validation

### Script de Test
Le fichier `test_specifications_access.php` permet de vérifier :
- Nombre de spécifications admin publiées
- Nombre de spécifications non-admin publiées
- Nombre de spécifications en attente/rejetées
- Validation de la logique d'accès

### Exécution du Test
```bash
php test_specifications_access.php
```

## 🚀 Déploiement

1. **Vérifier les migrations** : Aucune migration nécessaire
2. **Tester les routes** : Vérifier l'accès avec différents types d'utilisateurs
3. **Valider les filtres** : Tester la recherche et le filtrage
4. **Vérifier les permissions** : S'assurer que seuls les admins peuvent publier

## 📝 Notes Importantes

- Les spécifications existantes publiées par des utilisateurs non-admin restent visibles pour les abonnés
- Seules les nouvelles spécifications sont soumises à cette restriction
- Le middleware peut être étendu pour d'autres fonctionnalités si nécessaire
- La logique est cohérente entre la vitrine publique et la vitrine abonnés 