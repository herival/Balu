<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 */
class Recette
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $preparation;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="recettes")
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="recette")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="recette")
     */
    private $commandes;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="recettes")
     */
    private $membre;

    /**
     * @ORM\OneToMany(targetEntity=Detailcommande::class, mappedBy="recette")
     */
    private $detailcommandes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vente;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=PackIngredient::class, mappedBy="recette", orphanRemoval=true)
     */
    private $packIngredients;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $cuisson;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $tpspreparation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrepersonne;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $difficulte;

    /**
     * @ORM\ManyToOne(targetEntity=Souscategorie::class, inversedBy="recettes")
     */
    private $souscategorie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->detailcommandes = new ArrayCollection();
        $this->packIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(?string $preparation): self
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function getCategorie(): ?categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setRecette($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getRecette() === $this) {
                $commentaire->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setRecette($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getRecette() === $this) {
                $commande->setRecette(null);
            }
        }

        return $this;
    }

    public function getMembre(): ?membre
    {
        return $this->membre;
    }

    public function setMembre(?membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }

    /**
     * @return Collection|Detailcommande[]
     */
    public function getDetailcommandes(): Collection
    {
        return $this->detailcommandes;
    }

    public function addDetailcommande(Detailcommande $detailcommande): self
    {
        if (!$this->detailcommandes->contains($detailcommande)) {
            $this->detailcommandes[] = $detailcommande;
            $detailcommande->setRecette($this);
        }

        return $this;
    }

    public function removeDetailcommande(Detailcommande $detailcommande): self
    {
        if ($this->detailcommandes->contains($detailcommande)) {
            $this->detailcommandes->removeElement($detailcommande);
            // set the owning side to null (unless already changed)
            if ($detailcommande->getRecette() === $this) {
                $detailcommande->setRecette(null);
            }
        }

        return $this;
    }

    public function getVente(): ?bool
    {
        return $this->vente;
    }

    public function setVente(bool $vente): self
    {
        $this->vente = $vente;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection|PackIngredient[]
     */
    public function getPackIngredients(): Collection
    {
        return $this->packIngredients;
    }

    public function addPackIngredient(PackIngredient $packIngredient): self
    {
        if (!$this->packIngredients->contains($packIngredient)) {
            $this->packIngredients[] = $packIngredient;
            $packIngredient->setRecette($this);
        }

        return $this;
    }

    public function removePackIngredient(PackIngredient $packIngredient): self
    {
        if ($this->packIngredients->contains($packIngredient)) {
            $this->packIngredients->removeElement($packIngredient);
            // set the owning side to null (unless already changed)
            if ($packIngredient->getRecette() === $this) {
                $packIngredient->setRecette(null);
            }
        }

        return $this;
    }

    public function getCuisson(): ?\DateTimeInterface
    {
        return $this->cuisson;
    }

    public function setCuisson(?\DateTimeInterface $cuisson): self
    {
        $this->cuisson = $cuisson;

        return $this;
    }

    public function getTpspreparation(): ?\DateTimeInterface
    {
        return $this->tpspreparation;
    }

    public function setTpspreparation(?\DateTimeInterface $tpspreparation): self
    {
        $this->tpspreparation = $tpspreparation;

        return $this;
    }

    public function getNbrepersonne(): ?int
    {
        return $this->nbrepersonne;
    }

    public function setNbrepersonne(?int $nbrepersonne): self
    {
        $this->nbrepersonne = $nbrepersonne;

        return $this;
    }

    public function getDifficulte(): ?string
    {
        return $this->difficulte;
    }

    public function setDifficulte(?string $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getSouscategorie(): ?Souscategorie
    {
        return $this->souscategorie;
    }

    public function setSouscategorie(?Souscategorie $souscategorie): self
    {
        $this->souscategorie = $souscategorie;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }
}
