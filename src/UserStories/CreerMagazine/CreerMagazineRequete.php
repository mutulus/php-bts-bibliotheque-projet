<?php

namespace App\UserStories\CreerMagazine;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * # CreerMagazineRequete
 *  **Création de la requête avec: new CreerMagazineRequete(string titre,int numero)**
 */
class CreerMagazineRequete
{
    /**
     * Déclaration du titre du magazine
     * @var string
     */
    #[Assert\NotBlank(
        message: 'Le titre est obligatoire'
    )]
    public string $titre;
    /**
     * Déclaration du titre du magazine
     * @var int
     */
    #[Assert\NotBlank(
        message: 'Le numero de magazine est obligatoire'
    )]

    public int $numero;
    #[Assert\NotBlank(
        message: 'La date de publication est obligatoire'
)]
    public \DateTime $datePublication;

    /**
     *  ## Création de la requête avec les informations du magazine
     * @param string $titre
     * @param int $numero
     * @param \DateTime $datePublication
     */
    public function __construct(string $titre, int $numero,\DateTime $datePublication)
    {
        $this->titre = $titre;
        $this->numero = $numero;
        $this->datePublication=$datePublication;
    }


}