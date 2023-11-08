<?php

namespace App\Validateurs;

use App\entity\Adherent;
use App\UserStories\CreerAdherent\CreerAdherent;
use App\UserStories\CreerAdherent\CreerAdherentRequete;
use Doctrine\ORM\EntityManager;
use function PHPUnit\Framework\throwException;

class Validateur
{
    public function mailDispo(CreerAdherentRequete $adherent,EntityManager $entityManager):bool{
        $repository=$entityManager->getRepository(CreerAdherentRequete::class);
        if ($repository->findOneBy(['mailAdherent' =>$adherent->email])){
           throw new \Exception("Le mail est deja utilise");
        }else{
            return true;
        }
    }
}