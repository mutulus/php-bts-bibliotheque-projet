<?php

namespace app;

abstract class Media
{
    protected int $id;
    protected string $titre;
    protected string $statut;
    protected \DateTime $dateCreation;

    public function __construct()
    {
    }



}