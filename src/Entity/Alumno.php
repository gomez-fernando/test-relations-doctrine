<?php

namespace App\Entity;

use App\Repository\AlumnoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlumnoRepository::class)
 */
class Alumno
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\ManyToMany(targetEntity=Signature::class, inversedBy="alumnos" , cascade={"persist"})
     */
    private $signature;

    public function __construct()
    {
        $this->signature = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection|Signature[]
     */
    public function getSignature(): Collection
    {
        return $this->signature;
    }

    public function addSignature(Signature $signature): self
    {
        if (!$this->signature->contains($signature)) {
            $this->signature[] = $signature;
        }

        return $this;
    }

    public function removeSignature(Signature $signature): self
    {
        $this->signature->removeElement($signature);

        return $this;
    }
}
