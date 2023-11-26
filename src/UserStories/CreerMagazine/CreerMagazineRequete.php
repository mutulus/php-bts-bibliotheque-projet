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

    /**
     *  ## Création de la requête avec les informations du magazine
     * @param string $titre
     * @param int $numero
     */
    public function __construct(string $titre, int $numero)
    {
        $this->titre = $titre;
        $this->numero = $numero;
    }


}