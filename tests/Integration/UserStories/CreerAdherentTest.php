<?php

namespace Tests\integration\UserStories;

use App\entity\Adherent;
use App\Services\GenerateurNumeroAdherent;
use App\UserStories\CreerAdherent\CreerAdherent;
use App\UserStories\CreerAdherent\CreerAdherentRequete;
use App\Validateurs\Validateur;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreerAdherentTest extends TestCase
{
    protected EntityManagerInterface $entityManager;
    protected GenerateurNumeroAdherent $generateurNumeroAdherent;
    protected ValidatorInterface $validator;
    protected Validateur $validateurBDD;
// Methode exectuée avant chaque test
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
        $this->generateurNumeroAdherent=new GenerateurNumeroAdherent();
        $this->validator=Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $this->validateurBDD=new Validateur();

        // Création du schema de la base de données
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->createSchema($metadata);
    }


    #[test]
    public function creerAdherent_ValeursCorrectes_True() {
        // Arrange
        $requete=new CreerAdherentRequete("Arturs","Mednis",'artursmednis@gmail.com');
        $creerAdherent=new CreerAdherent($this->entityManager,$this->generateurNumeroAdherent,$this->validator,$this->validateurBDD);
        // Act
        $resultat=$creerAdherent->execute($requete);
        // Assert
        $repository=$this->entityManager->getRepository(Adherent::class);
        $adherent=$repository->findOneBy(['mailAdherent'=>"artursmednis@gmail.com"]);
        $this->assertNotNull($adherent);
        $this->assertEquals("Arturs",$adherent->getPrenomAdherent());
        $this->assertEquals("Mednis",$adherent->getNomAdherent());
    }
    #[test]
    public function creerAdherent_ValeursIncorrectes_Null()
    {
        // Arrange
        $requete = new CreerAdherentRequete("Arturs", "", 'artursmednis@gmail.com');
        $creerAdherent = new CreerAdherent($this->entityManager, $this->generateurNumeroAdherent, $this->validator,$this->validateurBDD);
        // Act
        $resultat = $creerAdherent->execute($requete);
        // Assert
        $repository = $this->entityManager->getRepository(Adherent::class);
        $adherent = $repository->findOneBy(['mailAdherent' => "artursmednis@gmail.com"]);
        $this->assertNull($adherent);

    }
}