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
}