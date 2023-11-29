<?php

require_once "bootstrap.php";

use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerLivre\CreerLivreRequete;
use App\UserStories\CreerMagazine\CreerMagazine;
use App\UserStories\CreerMagazine\CreerMagazineRequete;
use App\Validateurs\Validateur;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validation;

$app = new \Silly\Application();

$app->command('creerLivre', function (SymfonyStyle $io) use ($entityManager) {

    $io->title('Créer un livre');
    $io->note("Il est nécessaire de remplir chaque champ avec les valeurs corrects");
    $io->text("Voici l'interface de création et d'insertion dans la base de données d'un livre");
    $titre = $io->ask("Entrez le titre du livre");

    $isbn = $io->ask("Entrez l'isbn du livre");

    $auteur = $io->ask("Entrez l'auteur du livre");

    $nbPages = $io->ask("Entrez le nombre de pages du livre");

    $dateParution = $io->ask("Entrez la date de parution du livre au format jj/mm/YYYY");

    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $validateurBDD = new Validateur();
    $requete = new CreerLivreRequete($titre, $isbn, $auteur, $nbPages, $dateParution);
    $creerLivre = new CreerLivre($entityManager,$validateur, $validateurBDD);
    $creerLivre->execute($requete);
    $io->success("Un livre a bien été inséré dans la base de données");
});


$app->command('creerMagazine', function (SymfonyStyle $io) use ($entityManager) {

    $io->title('Créer un Magazine');
    $io->note("Il est nécessaire de remplir chaque champ avec les valeurs corrects");
    $io->text("Voici l'interface de création et d'insertion dans la base de données d'un magazine");
    $titre = $io->ask("Entrez le titre du magazine");

    $numero = $io->ask("Entrez le numéro du magazine");

    $datePublication=$io->ask("Veuillez saisir la date de publication du magazine au format jj/mm/AAAA");

    $datePubli=DateTime::createFromFormat("d/m/Y",$datePublication);

    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $validateurBDD = new Validateur();
    $requete = new CreerMagazineRequete($titre,$numero,$datePubli);
    $creerMagazine = new CreerMagazine($entityManager,$validateur, $validateurBDD);
    $creerMagazine->execute($requete);
    $io->success("Un magazine a bien été inséré dans la base de données");
});


$app->run();

