<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Prize", mappedBy="qrcodes")
     */
    private $prizes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
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
     * @ORM\PrePersist()
     */
    public function onPrePersist(){
        $this->createdAt = new \DateTime();
    }
}
