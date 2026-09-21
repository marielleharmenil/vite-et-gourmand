<?php

namespace App\Entity;

use App\Repository\CustomerOrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerOrderRepository::class)]
class CustomerOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'customerOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'customerOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Menu $menu = null;

    #[ORM\Column]
    private ?int $people = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $deliveryDate = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $deliveryTime = null;

    #[ORM\Column(length: 255)]
    private ?string $deliveryAddress = null;

    #[ORM\Column(length: 20)]
    private ?string $deliveryPostalCode = null;

    #[ORM\Column(length: 100)]
    private ?string $deliveryCity = null;

    #[ORM\Column]
    private float $distanceKm = 0;

    #[ORM\Column]
    private float $menuPrice = 0;

    #[ORM\Column]
    private float $discount = 0;

    #[ORM\Column]
    private float $deliveryFee = 5;

    #[ORM\Column]
    private float $totalPrice = 0;

    #[ORM\Column(length: 50)]
    private string $status = 'en attente';

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): static
    {
        $this->menu = $menu;
        return $this;
    }

    public function getPeople(): ?int
    {
        return $this->people;
    }

    public function setPeople(int $people): static
    {
        $this->people = $people;
        return $this;
    }

    public function getDeliveryDate(): ?\DateTime
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(\DateTime $deliveryDate): static
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    public function getDeliveryTime(): ?\DateTime
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime(\DateTime $deliveryTime): static
    {
        $this->deliveryTime = $deliveryTime;
        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(string $deliveryAddress): static
    {
        $this->deliveryAddress = $deliveryAddress;
        return $this;
    }

    public function getDeliveryPostalCode(): ?string
    {
        return $this->deliveryPostalCode;
    }

    public function setDeliveryPostalCode(string $deliveryPostalCode): static
    {
        $this->deliveryPostalCode = $deliveryPostalCode;
        return $this;
    }

    public function getDeliveryCity(): ?string
    {
        return $this->deliveryCity;
    }

    public function setDeliveryCity(string $deliveryCity): static
    {
        $this->deliveryCity = $deliveryCity;
        return $this;
    }

    public function getDistanceKm(): float
    {
        return $this->distanceKm;
    }

    public function setDistanceKm(float $distanceKm): static
    {
        $this->distanceKm = $distanceKm;
        return $this;
    }

    public function getMenuPrice(): float
    {
        return $this->menuPrice;
    }

    public function setMenuPrice(float $menuPrice): static
    {
        $this->menuPrice = $menuPrice;
        return $this;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): static
    {
        $this->discount = $discount;
        return $this;
    }

    public function getDeliveryFee(): float
    {
        return $this->deliveryFee;
    }

    public function setDeliveryFee(float $deliveryFee): static
    {
        $this->deliveryFee = $deliveryFee;
        return $this;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): static
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}