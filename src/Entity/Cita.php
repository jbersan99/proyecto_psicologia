<?php

namespace App\Entity;

use App\Repository\CitaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CitaRepository::class)
 */
class Cita
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_cita;

    /**
     * @ORM\Column(type="date")
     */
    private $hora_cita;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio_cita;

    /**
     * @ORM\Column(type="date")
     */
    private $creacion_cita;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipo_terapia;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaCita(): ?\DateTimeInterface
    {
        return $this->fecha_cita;
    }

    public function setFechaCita(\DateTimeInterface $fecha_cita): self
    {
        $this->fecha_cita = $fecha_cita;

        return $this;
    }

    public function getHoraCita(): ?\DateTimeInterface
    {
        return $this->hora_cita;
    }

    public function setHoraCita(\DateTimeInterface $hora_cita): self
    {
        $this->hora_cita = $hora_cita;

        return $this;
    }

    public function getPrecioCita(): ?int
    {
        return $this->precio_cita;
    }

    public function setPrecioCita(int $precio_cita): self
    {
        $this->precio_cita = $precio_cita;

        return $this;
    }

    public function getCreacionCita(): ?\DateTimeInterface
    {
        return $this->creacion_cita;
    }

    public function setCreacionCita(\DateTimeInterface $creacion_cita): self
    {
        $this->creacion_cita = $creacion_cita;

        return $this;
    }

    public function getTipoTerapia(): ?string
    {
        return $this->tipo_terapia;
    }

    public function setTipoTerapia(string $tipo_terapia): self
    {
        $this->tipo_terapia = $tipo_terapia;

        return $this;
    }
}
