<?php

namespace App\Services;

class GenerateurNumeroAdherent
{
    public function generer(): string
    {
        $numero='AD-';
        for ($i=0;$i<6;$i++) {
            $numero = $numero . random_int(0,9);
        }
        return $numero;
    }
}
// Après il faudra réaliser des tests unitaires pour assurer le fonctionnement de ce service