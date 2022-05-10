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

    /**
     * @ORM\Column(type="boolean")
     */
    private $personal_u_otro;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="citas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario_reserva;

    /**
     * @ORM\ManyToOne(targetEntity=TipoTerapia::class, inversedBy="citas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipoTerapia_reserva;

    /**
     * @ORM\ManyToOne(targetEntity=DatosOtra::class, inversedBy="citas")
     */
    private $datos_otro_reserva;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Valoracion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Puntuacion;

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

    public function getPersonalUOtro(): ?bool
    {
        return $this->personal_u_otro;
    }

    public function setPersonalUOtro(bool $personal_u_otro): self
    {
        $this->personal_u_otro = $personal_u_otro;

        return $this;
    }

    public function getUsuarioReserva(): ?User
    {
        return $this->usuario_reserva;
    }

    public function setUsuarioReserva(?User $usuario_reserva): self
    {
        $this->usuario_reserva = $usuario_reserva;

        return $this;
    }

    public function getTipoTerapiaReserva(): ?TipoTerapia
    {
        return $this->tipoTerapia_reserva;
    }

    public function setTipoTerapiaReserva(?TipoTerapia $tipoTerapia_reserva): self
    {
        $this->tipoTerapia_reserva = $tipoTerapia_reserva;

        return $this;
    }

    public function getDatosOtroReserva(): ?DatosOtra
    {
        return $this->datos_otro_reserva;
    }

    public function setDatosOtroReserva(?DatosOtra $datos_otro_reserva): self
    {
        $this->datos_otro_reserva = $datos_otro_reserva;

        return $this;
    }

    public function getValoracion(): ?string
    {
        return $this->Valoracion;
    }

    public function setValoracion(?string $Valoracion): self
    {
        $this->Valoracion = $Valoracion;

        return $this;
    }

    public function getPuntuacion(): ?int
    {
        return $this->Puntuacion;
    }

    public function setPuntuacion(?int $Puntuacion): self
    {
        $this->Puntuacion = $Puntuacion;

        return $this;
    }
}
