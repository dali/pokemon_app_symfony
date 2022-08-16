<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $japanese = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $english = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $chinese = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEnglish(): ?string
    {
        return $this->english;
    }

    public function setEnglish(?string $english): self
    {
        $this->english = $english;

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
}
