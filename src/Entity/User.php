<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="conducteur", orphanRemoval=true)
     */
    private $conducteurTrajets;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Trajet", mappedBy="passager")
     */
    private $passagerTrajets;

    public function __construct()
    {
        $this->conducteurTrajets = new ArrayCollection();
        $this->passagerTrajets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    /**
     * @return Collection|Trajet[]
     */
    public function getConducteurTrajets(): Collection
    {
        return $this->conducteurTrajets;
    }

    public function addConducteurTrajet(Trajet $conducteurTrajet): self
    {
        if (!$this->conducteurTrajets->contains($conducteurTrajet)) {
            $this->conducteurTrajets[] = $conducteurTrajet;
            $conducteurTrajet->setConducteur($this);
        }

        return $this;
    }

    public function removeConducteurTrajet(Trajet $conducteurTrajet): self
    {
        if ($this->conducteurTrajets->contains($conducteurTrajet)) {
            $this->conducteurTrajets->removeElement($conducteurTrajet);
            // set the owning side to null (unless already changed)
            if ($conducteurTrajet->getConducteur() === $this) {
                $conducteurTrajet->setConducteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getPassagerTrajets(): Collection
    {
        return $this->passagerTrajets;
    }

    public function addPassagerTrajet(Trajet $passagerTrajet): self
    {
        if (!$this->passagerTrajets->contains($passagerTrajet)) {
            $this->passagerTrajets[] = $passagerTrajet;
            $passagerTrajet->addPassager($this);
        }

        return $this;
    }

    public function removePassagerTrajet(Trajet $passagerTrajet): self
    {
        if ($this->passagerTrajets->contains($passagerTrajet)) {
            $this->passagerTrajets->removeElement($passagerTrajet);
            $passagerTrajet->removePassager($this);
        }

        return $this;
    }
}
