<?php

namespace App\entity;

class Adherent
{
    private int $id;
    private string $numeroAdherent;
    private string $prenomAdherent;
    private string $nomAdherent;
    private string $mailAdherent;
    private \DateTime $dateAdhesion;

    public function __construct()
    {
    }
}