<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nomComplet = null;

    /** @var Collection<int, ModeCotisation> */
    #[ORM\OneToMany(targetEntity: ModeCotisation::class, mappedBy: 'membre')]
    private Collection $modeCotisations;

    public function __construct()
    {
        $this->modeCotisations = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getNomComplet(): ?string { return $this->nomComplet; }
    public function setNomComplet(string $nomComplet): static { $this->nomComplet = $nomComplet; return $this; }

    /** @return Collection<int, ModeCotisation> */
    public function getModeCotisations(): Collection { return $this->modeCotisations; }

    public function addModeCotisation(ModeCotisation $m): static
    {
        if (!$this->modeCotisations->contains($m)) {
            $this->modeCotisations->add($m);
            $m->setMembre($this);
        }
        return $this;
    }

    public function removeModeCotisation(ModeCotisation $m): static
    {
        if ($this->modeCotisations->removeElement($m) && $m->getMembre() === $this) {
            $m->setMembre(null);
        }
        return $this;
    }
}