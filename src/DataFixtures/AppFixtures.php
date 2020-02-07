<?php

namespace App\DataFixtures;

use App\Entity\Film;
use App\Entity\Prize;
use App\Entity\Projet;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        // create 20 Projet
        for ($i = 0; $i < 20; $i++) {
            $projet = new Projet();
            $projet->setTitle('Film '.$i);
            $projet->setDescription("Description du film".$i);
            $projet->setPersons("Jacquie,Bernard,Bernadette,Marie,Pierre,Paul");

            //Create on BDD
            $manager->persist($projet);
        }
        // create 5 Prize
        for ($i = 0; $i < 5; $i++) {
            $prize = new Prize();
            $prize->setName('Prize '.$i);

            //Create on BDD
            $manager->persist($prize);
        }


        $manager->flush();
    }
}
