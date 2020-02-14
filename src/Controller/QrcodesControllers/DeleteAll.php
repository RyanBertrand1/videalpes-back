<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 14/02/2020
 * Time: 17:47
 */
namespace App\Controller\QrcodesControllers;

use App\Entity\Qrcode;
use App\Entity\Vote;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class DeleteAll
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke()
    {
        $repository = $this->em->getRepository(Qrcode::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $this->em->remove($entity);
        }
        $this->em->flush();

        return new Response('', Response::HTTP_OK);
    }
}