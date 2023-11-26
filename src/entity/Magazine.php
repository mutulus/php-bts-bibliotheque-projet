<?php

namespace App\entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class Magazine extends Media
{
    #[Column (type: "integer")]
    private int $numero;
    #[Column(type: "datetime")]
    private \DateTime $datePublication;

    public function __construct()
    {
        parent::__construct();
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    public function getDatePublication(): string
    {
        return $this->datePublication;
    }

    public function setDatePublication(string $datePublication): void
    {
        $date=\DateTime::createFromFormat("d/m/Y",$datePublication);
        $this->datePublication = $date;
    }



}