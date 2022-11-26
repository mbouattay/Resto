<?php

namespace App\Entity;

use App\Repository\RestoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestoRepository::class)]
class Resto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[ORM\Column(length: 35)]
    private ?string $adresse = null;

    #[ORM\Column(length: 8)]
    private ?string $tel = null;

    #[ORM\Column(length: 8)]
    private ?string $fax = null;

    #[ORM\Column(length: 20)]
    private ?string $ville = null;

    #[ORM\ManyToOne(inversedBy: 'resto')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reservation $reservation = null;

    #[ORM\ManyToOne(inversedBy: 'resto')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Restorateur $restorateur = null;

    #[ORM\OneToMany(mappedBy: 'resto', targetEntity: Reservation::class, orphanRemoval: true)]
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: 'resto', targetEntity: Commenter::class, orphanRemoval: true)]
    private Collection $commenter;

    #[ORM\OneToMany(mappedBy: 'resto', targetEntity: Menu::class, orphanRemoval: true)]
    private Collection $menu;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->commenter = new ArrayCollection();
        $this->menu = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getRestorateur(): ?Restorateur
    {
        return $this->restorateur;
    }

    public function setRestorateur(?Restorateur $restorateur): self
    {
        $this->restorateur = $restorateur;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setResto($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getResto() === $this) {
                $reservation->setResto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commenter>
     */
    public function getCommenter(): Collection
    {
        return $this->commenter;
    }

    public function addCommenter(Commenter $commenter): self
    {
        if (!$this->commenter->contains($commenter)) {
            $this->commenter->add($commenter);
            $commenter->setResto($this);
        }

        return $this;
    }

    public function removeCommenter(Commenter $commenter): self
    {
        if ($this->commenter->removeElement($commenter)) {
            // set the owning side to null (unless already changed)
            if ($commenter->getResto() === $this) {
                $commenter->setResto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu->add($menu);
            $menu->setResto($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menu->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getResto() === $this) {
                $menu->setResto(null);
            }
        }

        return $this;
    }
}
