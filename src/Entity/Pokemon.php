<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'pokemons')]
    private Collection $types;

    #[ORM\OneToOne(mappedBy: 'pokemon', cascade: ['persist', 'remove'])]
    private ?BaseStats $stats = null;

    #[ORM\Column(length: 255)]
    private ?string $english = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $japanese = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $chinese = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $french = null;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        $this->types->removeElement($type);

        return $this;
    }


    public function getStats(): ?BaseStats
    {
        return $this->stats;
    }

    public function setStats(?BaseStats $stats): self
    {
        // unset the owning side of the relation if necessary
        if ($stats === null && $this->stats !== null) {
            $this->stats->setPokemon(null);
        }

        // set the owning side of the relation if necessary
        if ($stats !== null && $stats->getPokemon() !== $this) {
            $stats->setPokemon($this);
        }

        $this->stats = $stats;

        return $this;
    }

    public function getEnglish(): ?string
    {
        return $this->english;
    }

    public function setEnglish(string $english): self
    {
        $this->english = $english;

        return $this;
    }

    public function getJapanese(): ?string
    {
        return $this->japanese;
    }

    public function setJapanese(?string $japanese): self
    {
        $this->japanese = $japanese;

        return $this;
    }

    public function getChinese(): ?string
    {
        return $this->chinese;
    }

    public function setChinese(?string $chinese): self
    {
        $this->chinese = $chinese;

        return $this;
    }

    public function getFrench(): ?string
    {
        return $this->french;
    }

    public function setFrench(?string $french): self
    {
        $this->french = $french;

        return $this;
    }

}
