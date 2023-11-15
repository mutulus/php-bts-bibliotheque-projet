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
    public function creerAdherent_ValeursIncorrectesVide_Exception()
    {
        // Arrange
        $requete = new CreerAdherentRequete("Arturs", "", 'artursmednis@gmail.com');
        $creerAdherent = new CreerAdherent($this->entityManager, $this->generateurNumeroAdherent, $this->validator,$this->validateurBDD);
        // Act

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Le ou les champs ne sont pas complets");
        $resultat = $creerAdherent->execute($requete);
    }
    #[test]
    public function creerAdherent_mailDejaUtilise_Exception(){
        $requete=new CreerAdherentRequete("Arturs","Mednis","artursmednis2003@gmail.com");
        $ceerAdherent=new CreerAdherent($this->entityManager,$this->generateurNumeroAdherent,$this->validator,$this->validateurBDD);

        $requete2=new CreerAdherentRequete("Arturse","Mednise","artursmednis2003@gmail.com");
        $ceerAdherent2=new CreerAdherent($this->entityManager,$this->generateurNumeroAdherent,$this->validator,$this->validateurBDD);

        $ceerAdherent->execute($requete);
        $this->expectException(\Exception::class);
        $ceerAdherent2->execute($requete);

    }

    /*#[test]
    public function creerAdherent_numeroUtilise_Exception(){
        $requete=new CreerAdherentRequete("Arturs","Mednis","artursmednis2003@gmail.com");
        $ceerAdherent=new CreerAdherent($this->entityManager,$this->generateurNumeroAdherent,$this->validator,$this->validateurBDD);
        $ceerAdherent->execute($requete);

        $adherent2=new Adherent();
        $adherent2->setNumeroAdherent("AD-12456");
        $adherentpush2=new CreerAdherent($this->entityManager,null,$this->validator,$this->validateurBDD);

        ;

    }*/
}