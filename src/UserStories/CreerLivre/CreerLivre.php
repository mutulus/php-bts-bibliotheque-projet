<?php

namespace App\UserStories\CreerLivre;

use App\entity\Livre;
use App\entity\Media;
use App\entity\Statut;
use App\Validateurs\Validateur;
use Doctrine\ORM\EntityManagerInterface;
use foo\bar;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreerLivre
{
    private EntityManagerInterface $entityManager;
    private ValidatorInterface $validator;
    private Validateur $validateurBDD;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @param Validateur $validateurBDD
     */
    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator, Validateur $validateurBDD)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->validateurBDD = $validateurBDD;
    }

    public function execute(CreerLivreRequete $requete):bool{
        // Vérification que les données saisies sont valides
        $violations=$this->validator->validate($requete);
        if (count($violations)==0){
            // Vérification si l'ISBN est unique
            $this->validateurBDD->isbnUtilise($requete,$this->entityManager);
            // Création du livre
            $livre=new Livre();
            $livre->setAuteur($requete->auteur);
            $livre->setTitre($requete->titre);
            $livre->setIsbn($requete->isbn);
            $livre->setDateParution($requete->dateParution);
            $livre->setNbPages($requete->nbPages);
            $repoStatut=$this->entityManager->getRepository(Statut::class);
            $livre->setStatut(Media::NOUVEAU);
            $date=new \DateTime();
            $livre->setDateCreation($date);
            $livre->setDureeEmprunt(21);
            // Persister en BDD
            $this->entityManager->persist($livre);
            $this->entityManager->flush();
            return true;

        }
        $errors=[];
        foreach ($violations as $violation){
            $errors[]=$violation->getMessage();
        }
            throw new \Exception($errors[0]);


    }


}