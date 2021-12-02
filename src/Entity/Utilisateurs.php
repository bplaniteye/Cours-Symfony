<?php

namespace App\Entity;

use App\Security\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateursRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UtilisateursRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Utilisateurs extends User
{
    protected $roles = [];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 2,
     * max = 50,
     * minMessage="Votre nom doit avoir au moins {{ limit }} caractères",
     * maxMessage="Votre nom ne doit pas dépasser {{ limit }} caractères")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 2,
     * max = 50,
     * minMessage="Votre prénom doit avoir au moins {{ limit }} caractère",
     * maxMessage="Votre prénom ne doit pas dépasser {{ limit }} caractères")   
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="Ce champ ne doit pas être nul")
     */
    private $photo;

    /**
     * @ORM\Column(type="date")
     */
    private $date_de_naissance;

    /**
     * @ORM\Column(type="string", length=255)     
     * @Assert\Length(
     * min=4,
     * max=15,
     * minMessage="Votre login doit avoir au moins {{ limit }} caractères",
     * maxMessage="Votre login ne doit pas dépasser {{ limit }} caractères")
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)   
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)   
     */
    protected $email;    

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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getdate_de_naissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

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

  

   
}
