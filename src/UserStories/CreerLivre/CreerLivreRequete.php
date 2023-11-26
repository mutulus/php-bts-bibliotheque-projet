<?php

namespace App\UserStories\CreerLivre;
use Symfony\Component\Validator\Constraints as Assert;
class CreerLivreRequete
{
#[Assert\NotBlank(
    message: 'Le titre est obligatoire'
)]
public string $titre;
#[Assert\NotBlank(
    message: "L'ISBN est obligatoire"
)]
public string $isbn;
#[Assert\NotBlank(
    message: "L'auteur est obligatoire"
)]public string $auteur;
#[Assert\NotBlank(
    message: 'Le nombre de pages est obligatoire'
)]
#[Assert\Positive(
    message: 'Le nombre de pages doit être positif'
)]
public int $nbPages;
#[Assert\NotBlank(
    message: 'La date de parution est obligatoire'
)]
/*#[Assert\DateTime(
    message: 'La date de parution doit être une date'
)]*/
public string $dateParution;

    /**
     * @param string $titre
     * @param string $isbn
     * @param string $auteur
     * @param int $nbPages
     * @param string $dateParution
     */
    public function __construct(string $titre, string $isbn, string $auteur, int $nbPages, string $dateParution)
    {
        $this->titre = $titre;
        $this->isbn = $isbn;
        $this->auteur = $auteur;
        $this->nbPages = $nbPages;
        $this->dateParution = $dateParution;
    }


}