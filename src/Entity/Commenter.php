<?php

namespace App\Entity;

use App\Repository\CommenterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommenterRepository::class)]
class Commenter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'commenter')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Resto $resto = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getResto(): ?Resto
    {
        return $this->resto;
    }

    public function setResto(?Resto $resto): self
    {
        $this->resto = $resto;

        return $this;
    }
}
