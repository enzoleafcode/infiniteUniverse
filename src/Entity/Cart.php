<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $cartDate = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    private ?User $user = null;

    /**
     * @var Collection<int, Goodie>
     */
    #[ORM\ManyToMany(targetEntity: Goodie::class, inversedBy: 'carts')]
    private Collection $goodies;

    public function __construct()
    {
        $this->goodies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCartDate(): ?\DateTimeInterface
    {
        return $this->cartDate;
    }

    public function setCartDate(\DateTimeInterface $cartDate): static
    {
        $this->cartDate = $cartDate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Goodie>
     */
    public function getGoodies(): Collection
    {
        return $this->goodies;
    }

    public function addGoody(Goodie $goody): static
    {
        if (!$this->goodies->contains($goody)) {
            $this->goodies->add($goody);
        }

        return $this;
    }

    public function removeGoody(Goodie $goody): static
    {
        $this->goodies->removeElement($goody);

        return $this;
    }
}
