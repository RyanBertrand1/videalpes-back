<?php


namespace App\Controller\LaunchControllers;


use App\Entity\Launch;
use Doctrine\ORM\EntityManagerInterface;

class LaunchById
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        return $this->em->getRepository(Launch::class)->find(1);

    }

}