<?php

namespace App\entity;

class Livre extends Media
{
private string $isbn;
private string $auteur;
private int $nbPages;

private int $dateLimite;


public function __construct()
{
    parent::__construct();
}

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function getAuteur(): string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): void
    {
        $this->auteur = $auteur;
    }

    public function getNbPages(): int
    {
        return $this->nbPages;
    }

    public function setNbPages(int $nbPages): void
    {
        $this->nbPages = $nbPages;
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