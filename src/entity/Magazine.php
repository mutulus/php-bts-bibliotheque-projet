<?php

namespace App\entity;

class Magazine extends Media
{
    private int $numero;
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

    public function getDatePublication(): \DateTime
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTime $datePublication): void
    {
        $this->datePublication = $datePublication;
    }



}