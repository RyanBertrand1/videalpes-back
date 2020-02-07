<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PrizeRepository")
 *
 * @ORM\HasLifecycleCallbacks()
 */
class Prize
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="prize", cascade={"persist", "remove"})
     */
    private $votes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Qrcode", inversedBy="prizes")
     */
    private $qrcodes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="prizes")
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->qrcodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes): void
    {
        $this->votes = $votes;
    }

    /**
     * @return mixed
     */
    public function getQrcodes()
    {
        return $this->qrcodes;
    }

    /**
     * @param mixed $qrcodes
     */
    public function setQrcodes($qrcodes): void
    {
        $this->qrcodes = $qrcodes;
    }

    public function addCodes(Qrcode $qrcode){
        $this->qrcodes->add($qrcode);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist(){
        $this->createdAt = new \DateTime();
    }
}
