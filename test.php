<?php

use App\UserStories\rendreDisponibleMedia\RendreDispoMedia;
use App\Validateurs\Validateur;

require_once "bootstrap.php";
$validateurBDD=new Validateur();
$generateur=new \App\Services\GenerateurNumeroEmprunt();
$creerEmprunt=new \App\UserStories\CreerEmprunt\CreerEmprunt($entityManager,$validateurBDD,$generateur);
$creerEmprunt->execute(77,2);


