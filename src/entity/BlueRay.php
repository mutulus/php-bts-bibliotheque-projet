<?php

namespace app;

class BlueRay extends Media
{
    private string $realisateur;
    private int $dureeMin;
    private int $anneeSortie;
    private int $dateLimite;

    public function __construct()
    {
        parent::__construct();
    }

}