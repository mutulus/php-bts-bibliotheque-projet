<?php
require_once "bootstrap.php";
require_once "vendor/autoload.php";
$validateur=\Symfony\Component\Validator\Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
$validateurBDD=new \App\Validateurs\Validateur();

$magazineRequete=new \App\UserStories\CreerMagazine\CreerMagazineRequete("Vogue",14567);
$magazine=new \App\UserStories\CreerMagazine\CreerMagazine($entityManager,$validateur,$validateurBDD);
$magazine->execute($magazineRequete);