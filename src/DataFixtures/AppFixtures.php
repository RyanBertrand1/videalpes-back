<?php

namespace App\DataFixtures;

use App\Entity\Launch;
use App\Entity\Prize;
use App\Entity\Projet;
use App\Entity\Type;
use App\Entity\Vote;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $titleType = ['Film','Photographie','site web'];
        $types = [];
        $projects = [];
        $prizes = [];

        $launch = new Launch();
        $launch->setAuthorization(true);
        $manager->persist($launch);

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
                $projects[$i] = $projet;
                //Create on BDD
                $manager->persist($projet);
        }
        // create 5 Prize
        for ($i = 0; $i < 5; $i++) {
            if ($i < count($titleType)) {
                $type = $types[$i];

                $prize = new Prize();
                $prize->setName('Prize ' . $i);
                $prize->setType($type);
                $prizes[$i] = $prize;

                //Create on BDD
                $manager->persist($prize);
            }
        }
        for ($j = 0; $j < 3; $j++) {
            // create 25 Vote Film 1 for prize 1
            for ($i = 0; $i < 25; $i++) {

                $vote = new Vote();
                $vote->setPrize($prizes[$j]);
                $vote->setProjet($projects[1]);
                //Create on BDD
                $manager->persist($vote);
            }

            // create 15 Vote Film 2 for prize 1
            for ($i = 0; $i < 15; $i++) {

                $vote = new Vote();
                $vote->setPrize($prizes[$j]);
                $vote->setProjet($projects[2]);
                //Create on BDD
                $manager->persist($vote);
            }

            // create 10 Vote Film 3 for prize 1
            for ($i = 0; $i < 10; $i++) {
                $vote = new Vote();
                $vote->setPrize($prizes[$j]);
                $vote->setProjet($projects[3]);
                //Create on BDD
                $manager->persist($vote);
            }

        }
        $manager->flush();
    }
}
