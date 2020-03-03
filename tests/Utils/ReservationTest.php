<?php


namespace App\Tests\Utils;


use App\Entity\Lieu;
use App\Entity\Trajet;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ReservationTest extends TestCase
{
    private $trajet;

    public function setUp(): void
    {
        $lieu1 = new Lieu();
        $lieu1->setNom("Voiron");
        $lieu1->setLatitude(45.3667);
        $lieu1->setLongitude(5.5833);

        $lieu2 = new Lieu();
        $lieu2->setNom("Annecy");
        $lieu2->setLatitude(45.9);
        $lieu2->setLongitude(6.1167);

        $conducteur = new User();
        $conducteur->setNom("ADMIN");
        $conducteur->setPrenom("Admin");
        $conducteur->setEmail("admin@gmail.com");
        $conducteur->setPassword("123456");

        $trajet = new Trajet();
        $trajet->setConducteur($conducteur);
        $trajet->setLieudepart($lieu1);
        $trajet->setLieuarrive($lieu2);
        $this->trajet = $trajet;
    }
}
