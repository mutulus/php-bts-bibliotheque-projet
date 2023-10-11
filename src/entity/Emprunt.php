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

    public function estEnCours():bool{
        if (isset($this->dateEmprunt) && empty($this->dateRetour)){
            return true;
        }else{
            return false;
        }
    }

    public function setDateEmprunt(string $dateEmprunt): void
    {
        $date=\DateTime::createFromFormat("d/m/Y",$dateEmprunt);
        $this->dateEmprunt = $date;
    }

    public function setDateRetourEstimee(string $dateRetourEstimee): void
    {
        $date=\DateTime::createFromFormat("d/m/Y",$dateRetourEstimee);
        $this->dateRetourEstimee = $date;
    }


    public function estRetard():bool{
        $dateActuelle=\DateTime::createFromFormat("d/m/Y",date("d/m/Y"));
        if ($dateActuelle>$this->dateRetourEstimee && empty($this->dateRetour)){
            return true;
        }else{
            return false;
        }
    }

}