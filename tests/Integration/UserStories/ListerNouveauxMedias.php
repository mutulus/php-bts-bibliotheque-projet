<?php

namespace App\tests\Integration\UserStories;

use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerLivre\CreerLivreRequete;
use App\Validateurs\Validateur;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ListerNouveauxMedias extends TestCase
{
    private EntityManagerInterface $entityManager;
    private ValidatorInterface $validator;
    private Validateur $validateurBDD;
    protected function setUp() : void
    {

        // Configuration de Doctrine pour les tests
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__.'/../../../src/'],
            true
        );

        // Configuration de la connexion à la base de données
        // Utilisation d'une base de données SQLite en mémoire
        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'path' => ':memory:'
        ], $config);

        // Création de l'entity manager
        $this->entityManager = new EntityManager($connection, $config);
        $this->validator=Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $this->validateurBDD=new Validateur();

        // Création du schema de la base de données
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->createSchema($metadata);
    }
    #[Test]
    public function listerNouveauxMedias_Succes_NotNull(){
        //Arrange
        $livre=new CreerLivre($this->entityManager,$this->validator,$this->validateurBDD);
        $requete=new CreerLivreRequete("test","4584d","Tom",478,"01/12/2023");
        $livre->execute($requete);
        $lister=new \App\UserStories\ListerNouveauxMedias\ListerNouveauxMedias($this->entityManager);
        //Act
        $medias=$lister->execute();

        //Assert
        $this->assertNotNull($medias);

    }
    #[Test]
    public function listerNouveauxMedias_MediasNouveauNonPresentEnBDD_Empty(){
        //Arrange
        $lister=new \App\UserStories\ListerNouveauxMedias\ListerNouveauxMedias($this->entityManager);
        //Act
        $medias=$lister->execute();
        //Assert
        $this->assertEmpty($medias);

    }
    #[Test]
    public function listerNouveauxMedias_MediasOrdreDecroissant_True(){
        //Arrange
        $livre1=new CreerLivre($this->entityManager,$this->validator,$this->validateurBDD);
        $requete1=new CreerLivreRequete("test","458d","Tom",478,"01/12/2023");
        $livre1->execute($requete1);


        $livre2=new CreerLivre($this->entityManager,$this->validator,$this->validateurBDD);
        $requete2=new CreerLivreRequete("test","484d","Tom",478,"01/12/2023");
        $livre2->execute($requete2);

        $livre3=new CreerLivre($this->entityManager,$this->validator,$this->validateurBDD);
        $requete3=new CreerLivreRequete("test","584d","Tom",478,"01/12/2023");
        $livre3->execute($requete3);

        $lister=new \App\UserStories\ListerNouveauxMedias\ListerNouveauxMedias($this->entityManager);
        //Act
        $medias=$lister->execute();
        //Assert
        $dateMedia0=\DateTime::createFromFormat("d/m/Y",$medias[0]->getDateCreation());
        $dateMedia1=\DateTime::createFromFormat("d/m/Y",$medias[1]->getDateCreation());
        $dateMedia2=\DateTime::createFromFormat("d/m/Y",$medias[2]->getDateCreation());


        $this->assertGreaterThan($dateMedia0,$dateMedia1);
        $this->assertGreaterThan($dateMedia1,$dateMedia2);
        $this->assertGreaterThan($dateMedia0,$dateMedia2);
    }

}