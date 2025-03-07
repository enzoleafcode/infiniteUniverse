<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Goodie>
     */
    #[ORM\OneToMany(targetEntity: Goodie::class, mappedBy: 'category')]
    private Collection $goodies;

    public function __construct()
    {
        $this->goodies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
            $goody->setCategory($this);
        }

        return $this;
    }

    public function removeGoody(Goodie $goody): static
    {
        if ($this->goodies->removeElement($goody)) {
            // set the owning side to null (unless already changed)
            if ($goody->getCategory() === $this) {
                $goody->setCategory(null);
            }
        }

        return $this;
    }
}
