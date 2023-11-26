<?php

use Doctrine\ORM\EntityManagerInterface;

require_once "bootstrap.php";
require_once "vendor/autoload.php";


$validateur=\Symfony\Component\Validator\Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
$validateurBDD=new \App\Validateurs\Validateur();
$date=new DateTime('1987-08-08');
$livreRequete=new \App\UserStories\CreerLivre\CreerLivreRequete("Spider-man","AD487897","Marvel",675,'12/05/2023');
$livre=new \App\UserStories\CreerLivre\CreerLivre($entityManager,$validateur,$validateurBDD);
$livre->execute($livreRequete);
