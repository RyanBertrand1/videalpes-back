<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ApiResource(attributes={"pagination_enabled"=false},
 *     collectionOperations={
 *          "get",
 *          "post",
 *          "get_by_uuid"={
 *              "method"="GET",
 *              "path"="/qrcodes/get_by_uuid",
 *              "controller"="App\Controller\QrcodesControllers\GetByUuid"
 *          },
 *          "create_by_number"={
                "method"="POST",
 *              "path"="/qrcodes/create_by_number",
 *              "controller"="App\Controller\QrcodesControllers\createByNumber"
 *          }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\QrcodeRepository")
 *
 * @ORM\HasLifecycleCallbacks()
 */
class Qrcode
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="uuid", unique=true)
     */
    private $uuid;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Prize", mappedBy="qrcodes")
     */
    private $prizes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
        $this->prizes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPrizes()
    {
        return $this->prizes;
    }

    /**
     * @param mixed $prizes
     */
    public function setPrizes($prizes): void
    {
        $this->prizes = $prizes;
    }

    public function addPrize(Prize $prize){
        $this->prizes->add($prize);
        $prize->addCodes($this);
    }

    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getUuid(): \Ramsey\Uuid\UuidInterface
    {
        return $this->uuid;
    }

    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist(){
        $this->createdAt = new \DateTime();
    }
}
