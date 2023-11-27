<?php

require_once "bootstrap.php";
require_once "./vendor/autoload.php";

use Symfony\Component\Console\Output\OutputInterface;

$app = new \Silly\Application();

$app->command('creerLivre', function (\Symfony\Component\Console\Style\SymfonyStyle $io) use ($entityManager){
    $io->title('Créer un livre');
    $io->text("Voici l'interface de création et d'insertion dans la base de données d'un livre");
    $titre = $io->ask("Entrez le titre du livre");
    $isbn = $io->ask("Entrez l'isbn du livre");
    $auteur = $io->ask("Entrez l'auteur du livre");
    $nbPages = $io->ask("Entrez le nombre de pages du livre");
    $dateParution = $io->ask("Entrez la date de parution du livre");
    $validateur=\Symfony\Component\Validator\Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $validateurBDD = new \App\Validateurs\Validateur();
    $requete = new \App\UserStories\CreerLivre\CreerLivreRequete($titre, $isbn, $auteur, $nbPages, $dateParution);
    $creerLivre = new \App\UserStories\CreerLivre\CreerLivre($entityManager,$validateur,$validateurBDD);
    $creerLivre->execute($requete);
    $io->success("Un livre a bien été inséré dans la base de données");
});
$app->run();
