<?php

namespace App\UserStories\ListerNouveauxMedias;

use App\entity\Media;
use Doctrine\ORM\EntityManagerInterface;

class RecupererMedias
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute(){
        $repository=$this->entityManager->getRepository(Media::class);
        $media=$repository->findBy(['statut'=>'Nouveau'],["desc"]);

    }
}