<?php

use App\UserStories\rendreDisponibleMedia\RendreDispoMedia;
use App\Validateurs\Validateur;

require_once "bootstrap.php";

$changerStatut=new RendreDispoMedia($entityManager,new Validateur());
try {
    $changerStatut->execute(2);
}catch (Exception $e){
   echo  $e->getMessage();
}


