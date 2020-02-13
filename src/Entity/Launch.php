<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(collectionOperations={
            "get" = {"method"="GET",
 *                   "path"="/launches",
 *                   "controller"="App\Controller\LaunchControllers\LaunchById"}
 *     },
 *     itemOperations={"get", "put"})
 * @ORM\Entity(repositoryClass="App\Repository\LaunchRepository")
 */
class Launch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $authorization;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthorization(): ?bool
    {
        return $this->authorization;
    }

    public function setAuthorization(bool $authorization): self
    {
        $this->authorization = $authorization;

        return $this;
    }
}
