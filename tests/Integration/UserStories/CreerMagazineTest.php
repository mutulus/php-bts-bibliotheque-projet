<?php

namespace Tests\integration\UserStories;


use App\entity\Magazine;
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


class CreerMagazineTest extends TestCase
{
    private EntityManagerInterface $entityManager;
    private ValidatorInterface $validator;
    private Validateur $validateurBDD;

    protected function setUp() : void
    {
        echo "setup ---------------------------------------------------------";
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
    public function creerMagazine_ValeursCorrects_TRUE(){
        $magazineRequete=new \App\UserStories\CreerMagazine\CreerMagazineRequete("Vogue",14567);
        $Creermagazine=new \App\UserStories\CreerMagazine\CreerMagazine($this->entityManager,$this->validator,$this->validateurBDD);

        $Creermagazine->execute($magazineRequete);
        $repository=$this->entityManager->getRepository(Magazine::class);
        //Assert
        $magazine=$repository->findOneBy(['numero'=>14567]);
        $this->assertNotNull($magazine);
        $this->assertEquals("Vogue",$magazineRequete->titre);
    }
    #[Test]
    public function creerMagazine_ValeursIncorrects_Exception(){
        $magazineRequete=new \App\UserStories\CreerMagazine\CreerMagazineRequete("",14567);
        $Creermagazine=new \App\UserStories\CreerMagazine\CreerMagazine($this->entityManager,$this->validator,$this->validateurBDD);
        $this->expectException(\Exception::class);
        $Creermagazine->execute($magazineRequete);
    }
    #[Test]
    public function creerLivre_NumeroDejaUtilise_Exception(){
        $magazineRequete=new \App\UserStories\CreerMagazine\CreerMagazineRequete("Vogue",14567);
        $Creermagazine=new \App\UserStories\CreerMagazine\CreerMagazine($this->entityManager,$this->validator,$this->validateurBDD);
        $magazineRequete2=new \App\UserStories\CreerMagazine\CreerMagazineRequete("Vogue",14567);
        $Creermagazine2=new \App\UserStories\CreerMagazine\CreerMagazine($this->entityManager,$this->validator,$this->validateurBDD);
        $Creermagazine->execute($magazineRequete);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Ce numero est deja utilise");
        $Creermagazine2->execute($magazineRequete2);

    }



}