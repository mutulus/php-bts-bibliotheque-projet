<?php

namespace App\UserStories\CreerMagazine;
use Symfony\Component\Validator\Constraints as Assert;

class CreerMagazineRequete
{
    #[Assert\NotBlank(
        message: 'Le titre est obligatoire'
    )]
    public string $titre;
    #[Assert\NotBlank(
        message: 'Le numero de magazine est obligatoire'
    )]

    public int $numero;

    /**
     * @param string $titre
     * @param int $numero
     */
    public function __construct(string $titre, int $numero)
    {
        $this->titre = $titre;
        $this->numero = $numero;
    }


}