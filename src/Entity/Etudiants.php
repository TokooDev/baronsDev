<?php

namespace App\Entity;

use App\Repository\EtudiantsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=EtudiantsRepository::class)
 */
class Etudiants
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit faire au moins 2 caractères",
     *      maxMessage = "Votre nom ne doit pas dépasser 255 caractères",
     *      allowEmptyString = false
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre prénom doit faire au moins 2 caractères",
     *      maxMessage = "Votre prénom ne doit pas dépasser 255 caractères",
     *      allowEmptyString = false
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $datenaissance;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 9,
     *      max = 15,
     *      minMessage = "Votre numéro doit faire au moins 9 caractères",
     *      maxMessage = "Votre numéro ne doit pas dépasser 15 caractères",
     *      allowEmptyString = false
     * )
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 9,
     *      max = 15,
     *      minMessage = "Votre numéro doit faire au moins 9 caractères",
     *      maxMessage = "Votre numéro ne doit pas dépasser 15 caractères",
     *      allowEmptyString = false
     * )
     * 
     * @Assert\Email(
     *     message = "L'adresse{{ value }}' n'est pas une adresse email valide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 9,
     *      max = 50,
     *      minMessage = "Votre numéro doit faire au moins 9 caractères",
     *      maxMessage = "Votre numéro ne doit pas dépasser 50 caractères",
     *      allowEmptyString = false
     * )
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 5,
     *      max = 15,
     *      minMessage = "Votre numéro doit faire au moins 9 caractères",
     *      maxMessage = "Votre numéro ne doit pas dépasser 15 caractères",
     *      allowEmptyString = false
     * )
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=Chambres::class, inversedBy="etudiants")
     */
    private $chambre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
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

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getChambre(): ?Chambres
    {
        return $this->chambre;
    }

    public function setChambre(?Chambres $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }
}
