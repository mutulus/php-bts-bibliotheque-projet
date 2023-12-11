<?php

require_once "bootstrap.php";

use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerLivre\CreerLivreRequete;
use App\UserStories\CreerMagazine\CreerMagazine;
use App\UserStories\CreerMagazine\CreerMagazineRequete;
use App\UserStories\ListerNouveauxMedias\ListerNouveauxMedias;
use App\UserStories\rendreDisponibleMedia\RendreDispoMedia;
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
    if (empty($titre)){
        $titre="";
    }

    $isbn = $io->ask("Entrez l'isbn du livre");
    if (empty($isbn)){
        $isbn="";
    }

    $auteur = $io->ask("Entrez l'auteur du livre");
    if (empty($auteur)){
        $auteur="";
    }

    $nbPages = $io->ask("Entrez le nombre de pages du livre");
    if (empty($nbPages)){
        $nbPages=-1;
    }


    $dateParution = $io->ask("Entrez la date de parution du livre au format jj/mm/YYYY");
    if (empty($dateParution)){
        $dateParution="";
        //Enlever date parution de la base
    }


    $validateur = Validation::createValidatorBuilder()->getValidator();
    $validateurBDD = new Validateur();
    $requete = new CreerLivreRequete($titre, $isbn, $auteur, $nbPages, $dateParution);
    $creerLivre = new CreerLivre($entityManager,$validateur, $validateurBDD);
    try {
        $creerLivre->execute($requete);
    }catch (Exception $e){

        $io->error(explode("SE",$e->getMessage()));
    }

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

    $validateur = Validation::createValidatorBuilder()->getValidator();
    $validateurBDD = new Validateur();
    $requete = new CreerMagazineRequete($titre,$numero,$datePubli);
    $creerMagazine = new CreerMagazine($entityManager,$validateur, $validateurBDD);

    $creerMagazine->execute($requete);
    $io->success("Un magazine a bien été inséré dans la base de données");
});

$app->command('listerNouveauxMedias',function (SymfonyStyle $io,OutputInterface $output)use ($entityManager){

   $creerListe=new ListerNouveauxMedias($entityManager);
   $medias=$creerListe->execute();
   $table=new \Symfony\Component\Console\Helper\Table($output);
   $table->setHeaderTitle("Liste des nouveaux médias");
   $table->setHeaders(['id','titre','statut','dateCreation','typeMedia']);
  foreach ($medias as $media){
     $table->addRow([$media->getId(),$media->getTitre(),$media->getStatut(),$media->getDateCreation(),$media->getType()]);

  }
   $table->setStyle("borderless");
   $table->render();

});

$app->command('rendreMediaDispo',function (SymfonyStyle $io)use($entityManager){
    $changerStatut=new RendreDispoMedia($entityManager,new Validateur());
    $io->title('Rendre un média disponible');
    $idMedia=$io->ask("Saisir l'id du livre à rendre disponible");
    $changerStatut->execute($idMedia);
    $io->success("Le statut du média a bien été changé de 'Nouveau' à 'Disponible' !");

});

$app->run();

