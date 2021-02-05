<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Biblio::class, mappedBy="type")
     */
    private $biblios;

    public function __construct()
    {
        $this->biblios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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
            $biblio->setType($this);
        }

        return $this;
    }

    public function removeBiblio(Biblio $biblio): self
    {
        if ($this->biblios->removeElement($biblio)) {
            // set the owning side to null (unless already changed)
            if ($biblio->getType() === $this) {
                $biblio->setType(null);
            }
        }

        return $this;
    }
}
