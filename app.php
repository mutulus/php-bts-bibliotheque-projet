<?php

require_once "bootstrap.php";

use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerLivre\CreerLivreRequete;
use App\UserStories\CreerMagazine\CreerMagazine;
use App\UserStories\CreerMagazine\CreerMagazineRequete;
use App\Validateurs\Validateur;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validation;

$app = new \Silly\Application();

$app->command('creerLivre', function (\Symfony\Component\Console\Style\SymfonyStyle $io) use ($entityManager) {

    $io->title('Créer un livre');
    $io->text("Voici l'interface de création et d'insertion dans la base de données d'un livre");
    $titre = $io->ask("Entrez le titre du livre");
    while ($titre==null){
        $io->error("Le titre est invalide");
        $titre=$io->ask("Veuillez saisir un titre");
    }
    $isbn = $io->ask("Entrez l'isbn du livre");
    while ($isbn==null){
        $io->error("L'ISBN est invalide");
        $isbn=$io->ask("Veuillez saisir un isbn");
    }
    $auteur = $io->ask("Entrez l'auteur du livre");
    while ($auteur==null){
        $io->error("L'auteur est invalide");
        $auteur=$io->ask("Veuillez saisir un nom d'auteur");
    }
    $nbPages = $io->ask("Entrez le nombre de pages du livre");
    while ($nbPages==null or ($nbPages==0 or $nbPages<0 or is_numeric($nbPages)==false)){
        $io->error("Le nombre de pages saisis est invalide");
        $nbPages=$io->ask("Veuillez saisir le nombre de pages du livre");
    }
    $dateParution = $io->ask("Entrez la date de parution du livre au format jj/mm/YYYY");
    while ($dateParution == null  ){
        $io->error("La date de parution est invalide");
        $dateParution=$io->ask("Veuillez saisir la nouvelle date de parution");
    }
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $validateurBDD = new Validateur();
    $requete = new CreerLivreRequete($titre, $isbn, $auteur, $nbPages, $dateParution);
    $creerLivre = new CreerLivre($entityManager,$validateur, $validateurBDD);
    $creerLivre->execute($requete);
    $io->success("Un livre a bien été inséré dans la base de données");
});


$app->command('creerMagazine', function (\Symfony\Component\Console\Style\SymfonyStyle $io) use ($entityManager) {

    $io->title('Créer un Magazine');
    $io->note("Il est nécessaire de remplir chaque champ avec les valeurs corrects");
    $io->text("Voici l'interface de création et d'insertion dans la base de données d'un magazine");
    $titre = $io->ask("Entrez le titre du magazine");
    while ($titre==null){
        $io->error("Le titre est invalide");
        $titre=$io->ask("Veuillez saisir un titre");
    }
    $numero = $io->ask("Entrez le numéro du magazine");
    while ($numero==null or $numero<0 or is_numeric($numero)==false){
        $io->error("Le numéro est invalide");
        $numero=$io->ask("Veuillez saisir un numéro valide");
    }
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $validateurBDD = new Validateur();
    $requete = new CreerMagazineRequete($titre,$numero);
    $creerMagazine = new CreerMagazine($entityManager,$validateur, $validateurBDD);
    $creerMagazine->execute($requete);
    $io->success("Un magazine a bien été inséré dans la base de données");
});
$app->run();

