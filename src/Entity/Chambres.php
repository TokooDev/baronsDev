<?php

namespace App\Entity;

use App\Repository\ChambresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambresRepository::class)
 */
class Chambres
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numBat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numChamb;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Etudiants::class, mappedBy="numChamb")
     */
    private $etudiants;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumBat(): ?int
    {
        return $this->numBat;
    }

    public function setNumBat(int $numBat): self
    {
        $this->numBat = $numBat;

        return $this;
    }

    public function getNumChamb(): ?string
    {
        return $this->numChamb;
    }

    public function setNumChamb(string $numChamb): self
    {
        $this->numChamb = $numChamb;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Etudiants[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiants $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setNumChamb($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiants $etudiant): self
    {
        if ($this->etudiants->contains($etudiant)) {
            $this->etudiants->removeElement($etudiant);
            // set the owning side to null (unless already changed)
            if ($etudiant->getNumChamb() === $this) {
                $etudiant->setNumChamb(null);
            }
        }

        return $this;
    }
}
