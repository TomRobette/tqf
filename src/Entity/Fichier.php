<?php

namespace App\Entity;

use App\Repository\FichierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FichierRepository::class)
 */
class Fichier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $extension;

    /**
     * @ORM\Column(type="integer")
     */
    private $taille;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vrai_nom;

    /**
     * @ORM\OneToMany(targetEntity=Oeuvre::class, mappedBy="couverture")
     */
    private $oeuvres;

    /**
     * @ORM\OneToMany(targetEntity=Auteur::class, mappedBy="image")
     */
    private $auteurs;

    /**
     * @ORM\OneToMany(targetEntity=Biblio::class, mappedBy="image")
     */
    private $biblios;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
        $this->auteurs = new ArrayCollection();
        $this->biblios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getVraiNom(): ?string
    {
        return $this->vrai_nom;
    }

    public function setVraiNom(string $vrai_nom): self
    {
        $this->vrai_nom = $vrai_nom;

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
            $oeuvre->setCouverture($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): self
    {
        if ($this->oeuvres->removeElement($oeuvre)) {
            // set the owning side to null (unless already changed)
            if ($oeuvre->getCouverture() === $this) {
                $oeuvre->setCouverture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Auteur[]
     */
    public function getAuteurs(): Collection
    {
        return $this->auteurs;
    }

    public function addAuteur(Auteur $auteur): self
    {
        if (!$this->auteurs->contains($auteur)) {
            $this->auteurs[] = $auteur;
            $auteur->setImage($this);
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): self
    {
        if ($this->auteurs->removeElement($auteur)) {
            // set the owning side to null (unless already changed)
            if ($auteur->getImage() === $this) {
                $auteur->setImage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Biblio[]
     */
    public function getBiblios(): Collection
    {
        return $this->biblios;
    }

    public function addBiblio(Biblio $biblio): self
    {
        if (!$this->biblios->contains($biblio)) {
            $this->biblios[] = $biblio;
            $biblio->setImage($this);
        }

        return $this;
    }

    public function removeBiblio(Biblio $biblio): self
    {
        if ($this->biblios->removeElement($biblio)) {
            // set the owning side to null (unless already changed)
            if ($biblio->getImage() === $this) {
                $biblio->setImage(null);
            }
        }

        return $this;
    }
}
