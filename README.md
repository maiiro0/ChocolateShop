# ChocolateShop

## Initialiser la base de données après avoir récupéré `main`

Ouvrir un terminal dans le dossier du projet. Il faut PHP 8.4.1 ou plus récent, l’extension PHP `pdo_mysql` et Composer.

```sh
composer install
```

### Avec Docker

Démarrer Docker, puis lancer MariaDB. Docker crée la base `app` et le compte de développement correspondant aux valeurs de `.env`.

```sh
docker compose up -d --wait database
```

Symfony utilise la connexion de `.env` par défaut. Si `.env.local` contient déjà une ligne `DATABASE_URL` pour une autre base, retirer cette ligne pour utiliser la base Docker. Le port local 3306 doit être libre.

### Avec une installation locale de MySQL ou MariaDB, par exemple XAMPP

Démarrer le service MySQL ou MariaDB, puis créer un fichier `.env.local` à côté de `.env` avec une ligne de ce type.

```dotenv
DATABASE_URL="mysql://utilisateur:mot_de_passe@127.0.0.1:3306/chocolateshop?serverVersion=10.4.28-MariaDB&charset=utf8mb4"
```

Adapter le compte, le mot de passe, le port et `serverVersion` à l’installation locale. Si XAMPP utilise le compte `root` sans mot de passe, remplacer `utilisateur:mot_de_passe` par `root`. La commande `SELECT VERSION();` dans l’onglet SQL de phpMyAdmin permet de connaître la version du serveur. Pour MySQL, indiquer la version sans le suffixe `-MariaDB`. Git ignore `.env.local`, donc chacun peut y mettre ses propres identifiants.

Créer la base avec un compte qui en a le droit. Si la base a déjà été créée dans phpMyAdmin, passer directement aux migrations.

```sh
php bin/console doctrine:database:create --if-not-exists
```

### Créer les tables

Exécuter les migrations du projet, puis vérifier qu’elles sont toutes appliquées.

```sh
php bin/console doctrine:migrations:migrate
php bin/console doctrine:migrations:status
```

La migration initiale crée des tables vides. Les produits de démonstration du catalogue sont définis dans `src/Service/ProductCatalog.php`. Après avoir récupéré une nouvelle migration sur `main`, relancer `doctrine:migrations:migrate`.
