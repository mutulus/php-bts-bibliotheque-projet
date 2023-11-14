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
    #[Column(type: st)]
    protected string $titre;
    protected string $statut;
    protected \DateTime $dateCreation;

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

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): void
    {
        $this->statut = $statut;
    }

    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTime $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }

}

