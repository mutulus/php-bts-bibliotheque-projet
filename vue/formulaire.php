<?php
require "../vendor/autoload.php";
require "../bootstrap.php";



if ($_SERVER["REQUEST_METHOD"]=="POST" ){
    $validateur=\Symfony\Component\Validator\Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $validateurBDD=new \App\Services\GenerateurNumeroAdherent();


    try {
        $requete=new \App\UserStories\CreerAdherent\CreerAdherentRequete($_POST["prenom"],$_POST["nom"],$_POST["mail"]);
        $adherent=new \App\UserStories\CreerAdherent\CreerAdherent($entityManager,$validateurBDD,$validateur,new \App\Validateurs\Validateur());
        $status=$adherent->execute($requete);
    }catch (Exception $e){
        $message=$e->getMessage();
    }



}?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
</head>
<body>
<form action="" method="post">
    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" id="prenom">

    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom">

    <label for="mail">E-mail adhérent</label>
    <input type="text" name="mail" id="mail">

    <button type="submit">Valider</button>

</form>
<?php if (isset($message)) {?>
<?= $message ?>
<?php } ?>
</body>
</html>
