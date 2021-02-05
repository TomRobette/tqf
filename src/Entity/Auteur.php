<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuteurRepository::class)
 */
class Auteur
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDeces;

    /**
     * @ORM\Column(type="text")
     */
    private $bioCourte;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bioLongue;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $oeuvresExt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $liensWeb;

    /**
     * @ORM\ManyToMany(targetEntity=Oeuvre::class, mappedBy="auteurs")
     */
    private $oeuvres;

    /**
     * @ORM\ManyToOne(targetEntity=Fichier::class, inversedBy="auteurs")
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $caractere;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getDateDeces(): ?\DateTimeInterface
    {
        return $this->dateDeces;
    }

    public function setDateDeces(?\DateTimeInterface $dateDeces): self
    {
        $this->dateDeces = $dateDeces;

        return $this;
    }

    public function getBioCourte(): ?string
    {
        return $this->bioCourte;
    }

    public function setBioCourte(string $bioCourte): self
    {
        $this->bioCourte = $bioCourte;

        return $this;
    }

    public function getBioLongue(): ?string
    {
        return $this->bioLongue;
    }

    public function setBioLongue(?string $bioLongue): self
    {
        $this->bioLongue = $bioLongue;

        return $this;
    }

    public function getOeuvresExt(): ?string
    {
        return $this->oeuvresExt;
    }

    public function setOeuvresExt(?string $oeuvresExt): self
    {
        $this->oeuvresExt = $oeuvresExt;

        return $this;
    }

    public function getLiensWeb(): ?string
    {
        return $this->liensWeb;
    }

    public function setLiensWeb(?string $liensWeb): self
    {
        $this->liensWeb = $liensWeb;

        return $this;
    }

    /**
     * @return Collection|Oeuvre[]
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }

    public function addOeuvre(Oeuvre $oeuvre): self
    {
        if (!$this->oeuvres->contains($oeuvre)) {
            $this->oeuvres[] = $oeuvre;
            $oeuvre->addAuteur($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): self
    {
        if ($this->oeuvres->removeElement($oeuvre)) {
            $oeuvre->removeAuteur($this);
        }

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getCaractere(): ?string
    {
        return $this->caractere;
    }

    public function setCaractere(string $caractere): self
    {
        $this->caractere = $caractere;

        return $this;
    }
}
