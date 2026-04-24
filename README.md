# BookHub

Application Symfony de gestion de livres réalisée en binôme dans le cadre d'un TP Bachelor DWWM.

## Prérequis

- PHP 8.2
- Composer
- XAMPP (MySQL)
- Symfony CLI

## Installation

1. Cloner le repository
```bash
git clone https://github.com/Gregoire-F/BookHub.git
```

2. Installer les dépendances
```bash
composer install
```

3. Créer le fichier `.env.local` à la racine
⚠️ Chaque développeur doit mettre sa propre configuration 

- Jules : DATABASE_URL="mysql://root:@127.0.0.1:3306/bookhub?serverVersion=8.0.30&charset=utf8mb4"
- Grégoire : DATABASE_URL="mysql://root:root@127.0.0.1:8889/bookhub?serverVersion=5.7.24"

4. Créer la base de données
```bash
php bin/console doctrine:database:create
```
(Le nom doit correspondre à celui du `.env.local`)

5. Créer le schéma
```bash 
php bin/console doctrine:migrations:migrate
```

⚠️ En cas de problèmes de configurations 
```bash
php bin/console doctrine:schema:update --force
```

6. Charger les données de test
```bash
php bin/console doctrine:fixtures:load
```
- Création des tables et des relations 
    - 5 Books, 5 Authors, 5 Category
    - 1 User ["ROLE_ADMIN"] 

7. Lancer le serveur
```bash
symfony serve
```

## Accès

- Application : 
    - http://localhost:PORT (Selon config)
    - Jules (Xampp) -> http://localhost:8000
    - Gregoire (Mamp) -> http://127.0.0.1:8000/

### Login / Logout
- /login - Page de connexion
- /logout - Déconnexion
- Admin : admin@admin.fr / motdepasse (⚠️ Mdp en clair dans le cadre du TP)

### Register
- Possibilité de créer un compte (Rôle par défaut [] )

## Routes publiques

- `/` : page d'accueil
- `/books` : liste des livres
- `/books/{id}` : détail d'un livre
- `/authors` : liste des auteurs

## Routes admin (ROLE_ADMIN requis)

- `/admin/book` : CRUD livres
- `/admin/author` : CRUD auteurs
- `/admin/category` : CRUD catégories

## API

Lecture seule (GET uniquement). Réponses en JSON. Accessible publiquement sans authentification.

### Routes

- `GET /api/books` : liste de tous les livres (id, titre, année, auteur, catégorie)
- `GET /api/books/{id}` : détail d'un livre (+ description et catégorie)
- `GET /api/authors` : liste de tous les auteurs et leurs livres

### Gestion des erreurs

- `200` : succès
- `404` : livre introuvable (ex: `/api/books/999`)

### Exemple de réponse `/api/books`

```json
[
  {
    "id": 1,
    "title": "Les Misérables",
    "year": "1862-01-01T00:00:00+00:00",
    "Author": {
      "id": 1,
      "name": "Victor Hugo"
    },
    "category": {
      "id": 1,
      "name": "Roman"
    }
  }
]
```

## Tests

*(à compléter)*