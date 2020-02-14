<?php


namespace App\Controller\QrcodesControllers;


use App\Entity\Prize;
use App\Entity\Qrcode;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AddPrize
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(Request $request)
    {
        $qrcodeId = $request->get('qrcodeId');
        $prizeId = $request->get('prizeId');

        /**
         * @var Qrcode $qrcode
         */
        $qrcode = $this->em->getRepository(Qrcode::class)->find($qrcodeId);

        /**
         * @var Prize $prize
         */
        $prize = $this->em->getRepository(Prize::class)->find($prizeId);

        $qrcode->addPrize($prize);

        $this->em->persist($qrcode);

        $this->em->flush();
    }
}
