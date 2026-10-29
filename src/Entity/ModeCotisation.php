<?php

namespace App\Entity;

use App\Repository\ModeCotisationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeCotisationRepository::class)]
class ModeCotisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $isLibre = null;

    #[ORM\ManyToOne(inversedBy: 'modeCotisations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Campagne $campagne = null;

    #[ORM\ManyToOne(inversedBy: 'modeCotisations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Membre $membre = null;

    public function getId(): ?int { return $this->id; }
    public function isLibre(): ?bool { return $this->isLibre; }
    public function setIsLibre(bool $isLibre): static { $this->isLibre = $isLibre; return $this; }
    public function getCampagne(): ?Campagne { return $this->campagne; }
    public function setCampagne(?Campagne $c): static { $this->campagne = $c; return $this; }
    public function getMembre(): ?Membre { return $this->membre; }
    public function setMembre(?Membre $m): static { $this->membre = $m; return $this; }
}