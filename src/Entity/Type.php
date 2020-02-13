<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={"groups"={"type_list"}}, attributes={"pagination_enabled"=false},)
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Type
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"prize_list", "type_list", "projet_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"prize_list", "type_list", "projet_list"})
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projet", mappedBy="type")
     */
    private $projets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prize", mappedBy="type")
     */
    private $prizes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProjets()
    {
        return $this->projets;
    }

    /**
     * @param mixed $projets
     */
    public function setProjets($projets): void
    {
        $this->projets = $projets;
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

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist()
     * @throws \Exception
     */
    public function onPrePersist(){
        $this->createdAt = new \DateTime();
    }
}
