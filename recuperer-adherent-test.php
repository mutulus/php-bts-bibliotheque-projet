<?php

require "bootstrap.php";
$adherents=$entityManager->getRepository(\App\entity\Adherent::class)->findAll();
dump($adherents);