<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LieuRepository")
 */
class Lieu
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
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="lieudepart")
     */
    private $departtrajet;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="lieuarrive")
     */
    private $arriveTrajet;

    public function __construct()
    {
        $this->departtrajet = new ArrayCollection();
        $this->arriveTrajet = new ArrayCollection();
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

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getDeparttrajet(): Collection
    {
        return $this->departtrajet;
    }

    public function addDepartTrajet(Trajet $departtrajet): self
    {
        if (!$this->departtrajet->contains($departtrajet)) {
            $this->departtrajet[] = $departtrajet;
            $departtrajet->setLieudepart($this);
        }

        return $this;
    }

    public function removeDepartTrajet(Trajet $departtrajet): self
    {
        if ($this->departtrajet->contains($departtrajet)) {
            $this->departtrajet->removeElement($departtrajet);
            // set the owning side to null (unless already changed)
            if ($departtrajet->getLieudepart() === $this) {
                $departtrajet->setLieudepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getArriveTrajet(): Collection
    {
        return $this->arriveTrajet;
    }

    public function addArriveTrajet(Trajet $arriveTrajet): self
    {
        if (!$this->arriveTrajet->contains($arriveTrajet)) {
            $this->arriveTrajet[] = $arriveTrajet;
            $arriveTrajet->setLieuarrive($this);
        }

        return $this;
    }

    public function removeArriveTrajet(Trajet $arriveTrajet): self
    {
        if ($this->arriveTrajet->contains($arriveTrajet)) {
            $this->arriveTrajet->removeElement($arriveTrajet);
            // set the owning side to null (unless already changed)
            if ($arriveTrajet->getLieuarrive() === $this) {
                $arriveTrajet->setLieuarrive(null);
            }
        }

        return $this;
    }
}
