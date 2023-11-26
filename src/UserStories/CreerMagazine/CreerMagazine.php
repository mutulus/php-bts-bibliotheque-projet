<?php

namespace App\UserStories\CreerMagazine;

use App\entity\Magazine;
use App\entity\Media;
use App\Validateurs\Validateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreerMagazine
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
    public function execute(CreerMagazineRequete $requete):bool{
        $violations=$this->validator->validate($requete);
        if (count($violations)==0){
            // Vérification si le numéro magazine est déjà utilisé
            $this->validateurBDD->numeroMagazineUtilise($requete,$this->entityManager);
            // Création du Magazine
            $magazine=new Magazine();
            $magazine->setTitre($requete->titre);
            $magazine->setNumero($requete->numero);
            $magazine->setDatePublication("01/12/2023");
            $magazine->setDateCreation(new \DateTime());
            $magazine->setDureeEmprunt(10);
            $magazine->setStatut(Media::NOUVEAU);
            // Persister en BDD
            $this->entityManager->persist($magazine);
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