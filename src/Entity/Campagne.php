<?php

namespace App\Entity;

use App\Repository\CampagneRepository;
use App\Trait\DateTimeTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampagneRepository::class)]
class Campagne
{
    use DateTimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateDebutAt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateFinAt = null;

    #[ORM\Column]
    private ?int $montant = null;

    #[ORM\ManyToOne(inversedBy: 'campagnes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeCampagne $typeCampagne = null;

    /** @var Collection<int, ModeCotisation> */
    #[ORM\OneToMany(targetEntity: ModeCotisation::class, mappedBy: 'campagne')]
    private Collection $modeCotisations;

    public function __construct()
    {
        $this->modeCotisations = new ArrayCollection();
        $this->initDate();
    }

    public function getId(): ?int { return $this->id; }
    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }
    public function getDateDebutAt(): ?\DateTime { return $this->dateDebutAt; }
    public function setDateDebutAt(\DateTime $d): static { $this->dateDebutAt = $d; return $this; }
    public function getDateFinAt(): ?\DateTime { return $this->dateFinAt; }
    public function setDateFinAt(?\DateTime $d): static { $this->dateFinAt = $d; return $this; }
    public function getMontant(): ?int { return $this->montant; }
    public function setMontant(int $montant): static { $this->montant = $montant; return $this; }
    public function getTypeCampagne(): ?TypeCampagne { return $this->typeCampagne; }
    public function setTypeCampagne(?TypeCampagne $t): static { $this->typeCampagne = $t; return $this; }

    /** @return Collection<int, ModeCotisation> */
    public function getModeCotisations(): Collection { return $this->modeCotisations; }

    public function addModeCotisation(ModeCotisation $m): static
    {
        if (!$this->modeCotisations->contains($m)) {
            $this->modeCotisations->add($m);
            $m->setCampagne($this);
        }
        return $this;
    }

    public function removeModeCotisation(ModeCotisation $m): static
    {
        if ($this->modeCotisations->removeElement($m) && $m->getCampagne() === $this) {
            $m->setCampagne(null);
        }
        return $this;
    }
}