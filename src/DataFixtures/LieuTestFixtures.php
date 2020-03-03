<?php

namespace App\DataFixtures;

use App\Entity\Lieu;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LieuTestFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $lieu1 = new Lieu();
        $lieu1->setNom("Voiron");
        $lieu1->setLatitude(45.3667);
        $lieu1->setLongitude(5.5833);

        $lieu2 = new Lieu();
        $lieu2->setNom("Annecy");
        $lieu2->setLatitude(45.9);
        $lieu2->setLongitude(6.1167);
        $manager->persist($lieu1);
        $manager->persist($lieu2);
        $manager->flush();
    }

}