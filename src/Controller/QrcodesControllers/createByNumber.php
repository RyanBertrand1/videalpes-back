<?php


namespace App\Controller\QrcodesControllers;


use App\Entity\Qrcode;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;

class createByNumber
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(Request $request)
    {
        $numbers = $request->get('number');
        $myVal = intval($numbers);
        for($i = 0; $i < $myVal;$i++){
            $qrcode = new Qrcode();

            $this->em->persist($qrcode);
        }
        $this->em->flush();

    }
}