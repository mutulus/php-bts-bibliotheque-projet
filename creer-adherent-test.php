<?php

require "bootstrap.php";

$adherent=new \App\entity\Adherent();
$adherent->setMailAdherent("artusdrs@gmail.com");
$adherent->setNumeroAdherent("AD-123456");
$adherent->setNomAdherent("Michelds");
$adherent->setPrenomAdherent("Tomd");
$adherent->setDateAdhesion("15/09/2023");


$entityManager->persist($adherent);
$entityManager->flush();
