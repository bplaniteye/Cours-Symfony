<?php

namespace App\Entity;

use App\Repository\AuteursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuteursRepository::class)
 */
class Auteurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
<<<<<<< HEAD
    private $Nom;
=======
    private $prenom;
>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f

    /**
     * @ORM\Column(type="string", length=255)
     */
<<<<<<< HEAD
    private $prenom;
=======
    private $nom;
>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
<<<<<<< HEAD
     * @ORM\ManyToMany(targetEntity=Articles::class, inversedBy="auteurs")
=======
     * @ORM\OneToMany(targetEntity=Articles::class, mappedBy="auteurs", orphanRemoval=true)
>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

<<<<<<< HEAD
    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;
=======
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f

        return $this;
    }

<<<<<<< HEAD
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
=======
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f

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

    /**
     * @return Collection|Articles[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Articles $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
<<<<<<< HEAD
=======
            $article->setAuteurs($this);
>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f
        }

        return $this;
    }

    public function removeArticle(Articles $article): self
    {
<<<<<<< HEAD
        $this->articles->removeElement($article);
=======
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getAuteurs() === $this) {
                $article->setAuteurs(null);
            }
        }
>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f

        return $this;
    }
}
