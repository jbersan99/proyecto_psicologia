<?php

namespace App\Entity;

use App\Repository\DatosOtraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=DatosOtraRepository::class)
 * @ApiResource()
 */
class DatosOtra
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Apellidos;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $DNI;

    /**
     * @ORM\Column(type="integer")
     */
    private $Edad;

    /**
     * @ORM\OneToMany(targetEntity=Cita::class, mappedBy="datos_otro_reserva")
     */
    private $citas;

    public function __construct()
    {
        $this->citas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->Apellidos;
    }

    public function setApellidos(string $Apellidos): self
    {
        $this->Apellidos = $Apellidos;

        return $this;
    }

    public function getDNI(): ?string
    {
        return $this->DNI;
    }

    public function setDNI(string $DNI): self
    {
        $this->DNI = $DNI;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->Edad;
    }

    public function setEdad(int $Edad): self
    {
        $this->Edad = $Edad;

        return $this;
    }

    /**
     * @return Collection<int, Cita>
     */
    public function getCitas(): Collection
    {
        return $this->citas;
    }

    public function addCita(Cita $cita): self
    {
        if (!$this->citas->contains($cita)) {
            $this->citas[] = $cita;
            $cita->setDatosOtroReserva($this);
        }

        return $this;
    }

    public function removeCita(Cita $cita): self
    {
        if ($this->citas->removeElement($cita)) {
            // set the owning side to null (unless already changed)
            if ($cita->getDatosOtroReserva() === $this) {
                $cita->setDatosOtroReserva(null);
            }
        }

        return $this;
    }
}
