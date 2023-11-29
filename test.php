<?php
require_once "bootstrap.php";
$listerNouveauMedia=new \App\UserStories\ListerNouveauxMedias\ListerNouveauxMedias($entityManager);
$medias=$listerNouveauMedia->execute();
dd($medias);

