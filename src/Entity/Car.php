<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Groups("showAllCar")
     */
    private $modele;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     * @Groups("showAllCar")
     */
    private $releasedate;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="cars", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("showAllCar")
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("showAllCar")
     */
    private $fuel;

    /**
     * @ORM\Column(type="smallint")
     */
    private $door;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $etat;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $slug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getReleasedate(): ?\DateTimeInterface
    {
        return $this->releasedate;
    }

    public function setReleasedate(?\DateTimeInterface $releasedate): self
    {
        $this->releasedate = $releasedate;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getDoor(): ?int
    {
        return $this->door;
    }

    public function setDoor(int $door): self
    {
        $this->door = $door;

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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
