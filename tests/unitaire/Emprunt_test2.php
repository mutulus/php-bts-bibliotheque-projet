<?php
require "./vendor/autoload.php";

echo "Test 1 : Test si un emprunt est en cours";
echo PHP_EOL;
$emprunt=new \App\entity\Emprunt();

$emprunt->setDateEmprunt("11/10/2023");
$enCours=$emprunt->estEnCours();


echo "++++++++++++++++++++++++++++++++++++++++++++++++++".PHP_EOL;

echo "Test 2 : Test si un emprunt est en retard";
echo PHP_EOL;

$emprunt2=new \App\entity\Emprunt();

$emprunt2->setDateEmprunt("1/10/2023");
$emprunt2->setDateRetourEstimee("10/10/2023");
$test=$emprunt2->estRetard();

if ($test){
    echo "TEST OK".PHP_EOL;
}else{
    echo "TEST PAS OK".PHP_EOL;
}