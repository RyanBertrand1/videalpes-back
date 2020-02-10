<?php


namespace App\Controller\QrcodesControllers;


use App\Entity\Qrcode;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetByUuid
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(Request $request)
    {
        $uuid = $request->get('uuid');

        return $this->em->getRepository(Qrcode::class)->findByUuid($uuid);
    }
}
