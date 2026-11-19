<?php

namespace App\Entity;

use App\Enum\ChocolateEnum;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    public function __construct(
        #[ORM\Column(length: 255)]
        private string $name,
        #[ORM\Column]
        private float $price,
        #[ORM\Column(length: 1000)]
        private string $note,
        #[ORM\Column(enumType: ChocolateEnum::class)]
        private ChocolateEnum $family,
        #[ORM\Column(length: 255)]
        private string $Country,
        #[ORM\Column]
        private bool $best_seller,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getFamily(): ChocolateEnum
    {
        return $this->family;
    }

    public function setFamily(ChocolateEnum $family): static
    {
        $this->family = $family;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): static
    {
        $this->Country = $Country;

        return $this;
    }

    public function isBestSeller(): bool
    {
        return $this->best_seller;
    }

    public function setBestSeller(bool $best_seller): static
    {
        $this->best_seller = $best_seller;

        return $this;
    }
}
