<?php

namespace App\Entity;

use App\Repository\TipoTerapiaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoTerapiaRepository::class)
 */
class TipoTerapia
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
    private $NombreTerapia;

    /**
     * @ORM\Column(type="integer")
     */
    private $ServiciosDisponibles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreTerapia(): ?string
    {
        return $this->NombreTerapia;
    }

    public function setNombreTerapia(string $NombreTerapia): self
    {
        $this->NombreTerapia = $NombreTerapia;

        return $this;
    }

    public function getServiciosDisponibles(): ?int
    {
        return $this->ServiciosDisponibles;
    }

    public function setServiciosDisponibles(int $ServiciosDisponibles): self
    {
        $this->ServiciosDisponibles = $ServiciosDisponibles;

        return $this;
    }
}
