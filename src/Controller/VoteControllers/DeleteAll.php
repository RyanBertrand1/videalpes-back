<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 14/02/2020
 * Time: 15:19
 */

namespace App\Controller\VoteControllers;

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
        $repository = $this->em->getRepository(Vote::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $this->em->remove($entity);
        }
        $this->em->flush();

        return new Response('', Response::HTTP_OK);
    }
}