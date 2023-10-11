<?php

namespace App\entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class Adherent
{
    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue]
    private int $id;
    #[Column(Length: 14)]
    private string $numeroAdherent;
    #[Column(Length: 50)]
    private string $prenomAdherent;
    #[Column(Length: 60)]
    private string $nomAdherent;
    #[Column(Length: 60)]
    private string $mailAdherent;
    #[Column(type: Types::date)]
    private \DateTime $dateAdhesion;

    public function __construct()
    {
    }
}