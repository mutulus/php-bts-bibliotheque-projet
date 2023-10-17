<?php

namespace App\tests\unitaire;

use App\entity\Emprunt;
use PHPUnit\Framework\TestCase;

class EmpruntTest extends TestCase
{
    /**
     * @test
     */
    public function testSiEmpruntEnCours_true(){
        $emprunt=new Emprunt();
        $emprunt->setDateEmprunt("17/10/2023");
        $resultat=$emprunt->estEnCours();
        $this->assertTrue($resultat);
    }

    /**
     * @test
     */
    public function testEmprunt_retard_true(){
        $emprunt=new Emprunt();
        $emprunt->setDateEmprunt("15/10/2023");
        $emprunt->setDateRetourEstimee("16/10/2023");
        $resultat=$emprunt->estRetard();
        $this->assertTrue($resultat);
    }
}