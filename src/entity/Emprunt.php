<?php

namespace App\entity;

use app\Media;

class Emprunt
{
    private int $id;
    private \DateTime $dateEmprunt;
    private \DateTime $dateRetourEstimee;
    private \DateTime $dateRetour;
    private Media $mediaEmprunte;
    private Adherent $emprunteur;

    public function __construct()
    {

    }


}