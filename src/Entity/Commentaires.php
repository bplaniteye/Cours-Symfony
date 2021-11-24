<?php

namespace App\Entity;

use App\Repository\CommentairesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentairesRepository::class)
 */
class Commentaires
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
    private $auteur;

    /**
<<<<<<< HEAD
=======
     * @ORM\Column(type="string", length=1000)
     */
    private $reponse;

    /**
>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
<<<<<<< HEAD
     * @ORM\Column(type="string", length=500)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="date")
     */
    private $date;
=======
     * @ORM\Column(type="datetime")
     */
    private $dateheure;

    /**
     * @ORM\ManyToOne(targetEntity=Articles::class, inversedBy="commentaires")
     */
    private $articles;
>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

<<<<<<< HEAD
=======
    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

<<<<<<< HEAD
    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;
=======
    public function getDateheure(): ?\DateTimeInterface
    {
        return $this->dateheure;
    }

    public function setDateheure(\DateTimeInterface $dateheure): self
    {
        $this->dateheure = $dateheure;
>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f

        return $this;
    }

<<<<<<< HEAD
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
=======
    public function getArticles(): ?Articles
    {
        return $this->articles;
    }

    public function setArticles(?Articles $articles): self
    {
        $this->articles = $articles;
>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f

        return $this;
    }
}
