<?php

namespace App\UserStories\ListerNouveauxMedias;

use DateTime;

class MediaFront
{
    private int $id;
    private string $titre;
    private string $statut;
    private DateTime $dateCreation;
    private string $type;

    /**
     * @param int $id
     * @param string $titre
     * @param string $statut
     * @param DateTime $dateCreation
     * @param string $type
     */
    public function __construct(int $id, string $titre, string $statut, DateTime $dateCreation, string $type)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->statut = $statut;
        $this->dateCreation = $dateCreation;
        $this->type = $type;
    }


}