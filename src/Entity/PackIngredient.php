<?php

namespace App\Entity;

use App\Repository\PackIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PackIngredientRepository::class)
 */
class PackIngredient
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
    private $libelle;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=Recette::class, mappedBy="pack_ingredient")
     */
    private $recettes;

    /**
     * @ORM\ManyToOne(targetEntity=Recette::class, inversedBy="packIngredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recette;

    /**
     * @ORM\Column(type="float")
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $unite;


    public function __construct()
    {
        $this->recettes = new ArrayCollection();
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes[] = $recette;
            $recette->setPackIngredient($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recettes->contains($recette)) {
            $this->recettes->removeElement($recette);
            // set the owning side to null (unless already changed)
            if ($recette->getPackIngredient() === $this) {
                $recette->setPackIngredient(null);
            }
        }

        return $this;
    }

    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): self
    {
        $this->recette = $recette;

        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getUnite(): ?string
    {
        return $this->unite;
    }

    public function setUnite(?string $unite): self
    {
        $this->unite = $unite;

        return $this;
    }

}
