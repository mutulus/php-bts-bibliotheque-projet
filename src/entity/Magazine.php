<?php

namespace app;

class Magazine extends Media
{
    private int $numero;
    private \DateTime $datePublication;
    private int $dateLimite;

    public function __construct()
    {
        parent::__construct();
    }

}