<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RendezVousRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RendezVousRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"rv:read"}},
 * denormalizationContext={"groups"={"rv:write"}},
 * )
 */
class RendezVous
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"rv:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"rv:read"})
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"rv:read"})
     */
    private $heur;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="rendezVouses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=StructureSante::class, inversedBy="rendezVouses")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"rv:read"})
     */
    private $structureSante;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeur(): ?string
    {
        return $this->heur;
    }

    public function setHeur(string $heur): self
    {
        $this->heur = $heur;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStructureSante(): ?StructureSante
    {
        return $this->structureSante;
    }

    public function setStructureSante(?StructureSante $structureSante): self
    {
        $this->structureSante = $structureSante;

        return $this;
    }
}