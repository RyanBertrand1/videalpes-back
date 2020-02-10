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
        $types = [];

        for($i = 0; $i< count($titleType); $i++){
            $type = new Type();
            $type->setTitle($titleType[$i]);

            $manager->persist($type);

            array_push($types, $type);
        }

        // create 10 Project
        $j = 0;
        for ($i = 0; $i < 10; $i++) {

                $type = $types[$j];

                $j++;

                if($j === count($types)){
                    $j = 0;
                }

                $projet = new Projet();
                $projet->setTitle('Film '.$i);
                $projet->setDescription("Description du film".$i);
                $projet->setPersons("Jacquie,Bernard,Bernadette,Marie,Pierre,Paul");
                $projet->setType($type);
                //Create on BDD
                $manager->persist($projet);
        }
        // create 5 Prize
        for ($i = 0; $i < 5; $i++) {
            if($i< count($titleType)) {
                $type = $types[$i];

                $prize = new Prize();
                $prize->setName('Prize '.$i);
                $prize->setType($type);
                //Create on BDD
                $manager->persist($prize);
            }
        }


        $manager->flush();
    }
}
