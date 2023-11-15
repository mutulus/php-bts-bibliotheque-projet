<?php

namespace App\entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;

#[entity]
#[InheritanceType("JOINED")]
#[DiscriminatorColumn(name: "type",type: "string")]
#[DiscriminatorMap(["livre"=>"Livre","magazine"=>"Magazine","BlueRay"=>"BlueRay"])]
abstract class Media
{
    #[id]
    #[GeneratedValue]
    #[Column(type: "integer")]
    protected int $id;
    #[Column(type: "string")]
    protected string $titre;
    #[Column(type: "string")]
    protected int $idStatut;
     #[Column(type: "datetime")]
    protected \DateTime $dateCreation;
     #[Column(type: "integer")]
    protected int $dureeEmprunt;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function getIdStatut(): int
    {
        return $this->idStatut;
    }

    public function setIdStatut(int $statut): void
    {
        $this->idStatut = $statut;
    }

    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTime $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }

    public function getDureeEmprunt(): int
    {
        return $this->dureeEmprunt;
    }

    public function setDureeEmprunt(int $dureeEmprunt): void
    {
        $this->dureeEmprunt = $dureeEmprunt;
    }

}

