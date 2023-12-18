<?php

namespace App\UserStories\CreerEmprunt;

use App\entity\Adherent;
use App\entity\Emprunt;
use App\entity\Media;
use App\entity\StatutMedia;
use App\Services\GenerateurNumeroEmprunt;
use App\Validateurs\Validateur;
use Doctrine\ORM\EntityManagerInterface;

class CreerEmprunt
{
    private EntityManagerInterface $entityManager;
    private Validateur $validateurBDD;
    private GenerateurNumeroEmprunt $numeroEmprunt;

    /**
     * @param EntityManagerInterface $entityManager
     * @param Validateur $validateurBDD
     */
    public function __construct(EntityManagerInterface $entityManager, Validateur $validateurBDD,GenerateurNumeroEmprunt $numeroEmprunt)
    {
        $this->entityManager = $entityManager;
        $this->validateurBDD = $validateurBDD;
        $this->numeroEmprunt=$numeroEmprunt;
    }

    public function execute(int $idMedia, int $idAdherent)
    {
        $emprunt=new Emprunt();
        // Vérifier que le média et l'adhérent sont en base de données
        $this->validateurBDD->adherentExistePas($this->entityManager, $idAdherent);
        $this->validateurBDD->mediaExistePas($this->entityManager, $idMedia);

        $adherent=$this->entityManager->find(Adherent::class,$idAdherent);
        $media=$this->entityManager->find(Media::class,$idMedia);
        $media->setStatut(StatutMedia::EMPRUNTE);
        $emprunt->setNumeroEmprunt($this->numeroEmprunt->generer());
        $emprunt->setDateEmprunt("18/12/2023");
        $emprunt->setAdherent($adherent);
        $emprunt->setMediaEmprunte($media);
        $emprunt->setDateRetourEstimee('20/12/2023');
        $this->entityManager->persist($emprunt);
        $this->entityManager->flush();

        return true;

    }

}