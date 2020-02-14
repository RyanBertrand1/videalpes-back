<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={"groups"={"projet_list"}},
 *  attributes={"pagination_enabled"=false},
 *     collectionOperations={
            "get",
 *          "post",
 *          "get_by_type"={
 *              "method"="GET",
                "path"="/projets/get_by_type",
 *              "controller"="App\Controller\ProjetControllers\GetByType"
 *          },
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 *
 * @ORM\HasLifecycleCallbacks()
 */
class Projet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"projet_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"projet_list"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"projet_list"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"projet_list"})
     */
    private $persons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="projet", cascade={"persist", "remove"})
     */
    private $votes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="projets", cascade={"persist"})
     * @Groups({"projet_list"})
     */
    private $type;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPersons(): ?string
    {
        return $this->persons;
    }

    public function setPersons(?string $persons): self
    {
        $this->persons = $persons;

        return $this;
    }

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
     * @throws \Exception
     */
    public function onPrePersist(){
        $this->createdAt = new \DateTime();
    }
}
