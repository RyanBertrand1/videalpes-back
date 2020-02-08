<?php


namespace App\Controller\ProjetControllers;


use App\Entity\Projet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class GetByType
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(Request $request)
    {
        $typeId = $request->get('typeId');

        return $this->em->getRepository(Projet::class)->findByTypeId($typeId);
    }
}
