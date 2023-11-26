<?php

namespace App\entity;

class BlueRay extends Media
{
    private string $realisateur;
    private int $dureeMin;
    private int $anneeSortie;
    private int $dateLimite;

    public function __construct()
    {
        parent::__construct();
    }

    public function getRealisateur(): string
    {
        return $this->realisateur;
    }

    public function setRealisateur(string $realisateur): void
    {
        $this->realisateur = $realisateur;
    }

    public function getDureeMin(): int
    {
        return $this->dureeMin;
    }

    public function setDureeMin(int $dureeMin): void
    {
        $this->dureeMin = $dureeMin;
    }

    public function getAnneeSortie(): int
    {
        return $this->anneeSortie;
    }

    public function setAnneeSortie(int $anneeSortie): void
    {
        $this->anneeSortie = $anneeSortie;
    }

    public function getDateLimite(): int
    {
        return $this->dateLimite;
    }

    public function setDateLimite(int $dateLimite): void
    {
        $this->dateLimite = $dateLimite;
    }

}