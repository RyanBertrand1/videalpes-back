<?php

namespace App\DataFixtures;

use App\Entity\Prize;
use App\Entity\Projet;
use App\Entity\Type;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $titleType = ['Film','Photographie','site web'];

        // create type for each title on array
        for($i = 0; $i < count($titleType);$i++){
            $type = new Type();
            $type->setTitle($titleType[$i]);

            $manager->persist($type);
        }

        // create 10 Project
        for ($i = 0; $i < 10; $i++) {
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
