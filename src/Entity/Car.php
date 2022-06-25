<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     */
    private $modele;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $releasedate;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=50)
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
}
