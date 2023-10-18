<?php

require "bootstrap.php";

$adherent=new \App\entity\Adherent();
$adherent->setMailAdherent("arturs@gmail.com");
$adherent->setNomAdherent("Michel");
$adherent->setPrenomAdherent("Tom");
$adherent->setDateAdhesion("17/10/2023");


$entityManager->persist($adherent);
$entityManager->flush();
