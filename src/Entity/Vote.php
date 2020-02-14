<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(attributes={"pagination_enabled"=false},
 *     collectionOperations={
            "get",
 *          "post",
 *          "get_vote_by_prize"={
 *              "method"="GET",
 *               "path"="/vote/get_vote_by_prize",
 *              "controller"="App\Controller\VoteControllers\GetVoteByPrize"},
 *
 *
 *     })
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 *
 * @ORM\HasLifecycleCallbacks()
 */
class Vote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prize", inversedBy="votes", cascade={"persist"})
     */
    private $prize;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet", inversedBy="votes", cascade={"persist"})
     */
    private $projet;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPrize()
    {
        return $this->prize;
    }

    /**
     * @param mixed $prize
     */
    public function setPrize($prize): void
    {
        $this->prize = $prize;
    }

    /**
     * @return mixed
     */
    public function getProjet()
    {
        return $this->projet;
    }

    /**
     * @param mixed $projet
     */
    public function setProjet($projet): void
    {
        $this->projet = $projet;
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
