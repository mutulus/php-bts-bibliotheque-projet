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
        if (empty($this->dateRetour)){
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
        //Faire si la date de retour est set et qu'elle est inférieure à la date de retour
        $dateActuelle=\DateTime::createFromFormat("d/m/Y",date("d/m/Y"));
        if ($dateActuelle>$this->dateRetourEstimee && empty($this->dateRetour)or($this->dateRetour > $this->dateRetourEstimee)){
            return true;
        }else{
            return false;
        }
    }

    public function getDateRetour(): \DateTime
    {
        return $this->dateRetour;
    }

    public function setDateRetour(string $dateRetour): void
    {
        $this->dateRetour = \DateTime::createFromFormat("d/m/Y",$dateRetour);
    }

    public function getMediaEmprunte(): Media
    {
        return $this->mediaEmprunte;
    }

    public function setMediaEmprunte(Media $mediaEmprunte): void
    {
        $this->mediaEmprunte = $mediaEmprunte;
    }

    public function getEmprunteur(): Adherent
    {
        return $this->emprunteur;
    }

    public function setEmprunteur(Adherent $emprunteur): void
    {
        $this->emprunteur = $emprunteur;
    }


}