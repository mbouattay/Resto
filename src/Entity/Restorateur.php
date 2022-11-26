<?php

namespace App\Entity;

use App\Repository\RestorateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestorateurRepository::class)]
class Restorateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[ORM\Column(length: 30)]
    private ?string $prenom = null;

    #[ORM\Column(length: 30)]
    private ?string $username = null;

    #[ORM\Column(length: 50)]
    private ?string $password = null;

    #[ORM\Column]
    private ?int $code_TVA = null;

    #[ORM\Column]
    private ?int $cin = null;

    #[ORM\Column(length: 50)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $tel = null;

    #[ORM\OneToMany(mappedBy: 'restorateur', targetEntity: Resto::class, orphanRemoval: true)]
    private Collection $resto;

    public function __construct()
    {
        $this->resto = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCodeTVA(): ?int
    {
        return $this->code_TVA;
    }

    public function setCodeTVA(int $code_TVA): self
    {
        $this->code_TVA = $code_TVA;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection<int, Resto>
     */
    public function getResto(): Collection
    {
        return $this->resto;
    }

    public function addResto(Resto $resto): self
    {
        if (!$this->resto->contains($resto)) {
            $this->resto->add($resto);
            $resto->setRestorateur($this);
        }

        return $this;
    }

    public function removeResto(Resto $resto): self
    {
        if ($this->resto->removeElement($resto)) {
            // set the owning side to null (unless already changed)
            if ($resto->getRestorateur() === $this) {
                $resto->setRestorateur(null);
            }
        }

        return $this;
    }

  
}
