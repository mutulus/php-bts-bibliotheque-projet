# User Stories
### Créer livre
``` Voici comment créer un livre et l'insérer dans la base de données ```
### Code source
* [Class principale](../../src/UserStories/CreerLivre/CreerLivre.php)
* [Class de requête](../../src/UserStories/CreerLivre/CreerLivreRequete.php)
### Etapes
* 1. Créer la requête grace à la Class de requête
* 2. Créer un objet de la Class principale avec les dépendances nécessaires
* 3. Utiliser la fonction execute avec en entrée la requête créée précedemment
* 4. **Le Livre est crée et mis dans la base de données**

### Procédures
* 1.
```php
    $requete = new CreerLivreRequete(string $titre, string $isbn, string $auteur, int $nombrePages, string $dateParution)
```
* 2.
La Class [Validateur](../../src/Validateurs/Validateur.php) va ici être utilisée comme dépendance afin de valider le fait que l'ISBN du livre n'est pas déjà utilisé par la fonction `isbnUtilise(CreerLivreRequete $livre,EntityManager $entityManager)`

```php
    $CreerLivre = new CreerLivre(EntityManagerInterface $entityManager, ValidatorInterface $validator, Validateur $validateurBDD)
```
* 3.
```php
    $CreerLivre->execute($requete)
```
* 4.
**_Le Livre sera crée et envoyé dans la base de donnée grace à l'entityManager_**








