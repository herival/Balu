<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;

    /**
     * @ORM\OneToMany(targetEntity=Detailcommande::class, mappedBy="commande")
     */
    private $detailcommandes;

    
    public function __construct()
    {
        $this->detailcommandes = new ArrayCollection();
        $this->date = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

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
            $detailcommande->setCommande($this);
        }

        return $this;
    }

    public function removeDetailcommande(Detailcommande $detailcommande): self
    {
        if ($this->detailcommandes->contains($detailcommande)) {
            $this->detailcommandes->removeElement($detailcommande);
            // set the owning side to null (unless already changed)
            if ($detailcommande->getCommande() === $this) {
                $detailcommande->setCommande(null);
            }
        }

        return $this;
    }
}
