<?php

namespace App\DataFixtures;

use App\Entity\Film;
use App\Entity\Prize;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        // create 20 Film
        for ($i = 0; $i < 20; $i++) {
            $film = new Film();
            $film->setName('Film '.$i);
            $film->setDescription("Description du film".$i);
            $film->setPersons("Jacquie,Bernard,Bernadette,Marie,Pierre,Paul");

            //Create on BDD
            $manager->persist($film);
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
