# User Stories
### Créer magazine
``` Voici comment créer un magazine et l'insérer dans la base de données ```
### Code source
* [Class principale](../src/UserStories/CreerMagazine/CreerMagazine.php)
* [Class de requête](../src/UserStories/CreerMagazine/CreerMagazineRequete.php)
### Etapes
* 1. Créer la requête grace à la Class de requête
* 2. Créer un objet de la Class principale avec les dépendances nécessaires
* 3. Utiliser la fonction execute avec en entrée la requête créée précedemment
* 4. **Le magazine est crée et mis dans la base de données**

### Procédures
* 1.
```php
    $requete = new CreerMagazineRequete(string $titre,int $numero)
```
* 2. 
La Class [Validateur](../src/Validateurs/Validateur.php) va ici être utilisée comme dépendance afin de valider le fait que le numéro du magazine n'est pas déjà utilisé par la fonction `numeroMagazineUtilise(CreerMagazineRequete $magazine,EntityManager $entityManager)`

```php
    $CreerMagazine = new CreerMagazine(EntityManagerInterface $entityManager, ValidatorInterface $validator, Validateur $validateurBDD)
```
* 3.
```php
    $CreerMagazine->execute($requete)
```
* 4.
**_Le Magazine sera crée et envoyé dans la base de donnée grace à l'entityManager_**








