<?php

namespace App\Entity;

use App\Repository\CitaRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CitaRepository::class)
 * @ApiResource()
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
     * @ORM\Column(type="integer")
     */
    private $precio_cita;

    /**
     * @ORM\Column(type="date")
     */
    private $creacion_cita;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="citas_usuario")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario_reserva;

    /**
     * @ORM\ManyToOne(targetEntity=DatosOtra::class, inversedBy="citas_otro")
     */
    private $datos_otro_reserva;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $valoracion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $puntuacion;

    /**
     * @ORM\Column(type="integer")
     */
    private $turno;

    /**
     * @ORM\ManyToOne(targetEntity=ServiciosDisponibles::class, inversedBy="ServicioEscogido")
     */
    private $ServicioEscogido;

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

    public function getUsuarioReserva(): ?User
    {
        return $this->usuario_reserva;
    }

    public function setUsuarioReserva(?User $usuario_reserva): self
    {
        $this->usuario_reserva = $usuario_reserva;

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
        return $this->valoracion;
    }

    public function setValoracion(?string $valoracion): self
    {
        $this->valoracion = $valoracion;

        return $this;
    }

    public function getPuntuacion(): ?int
    {
        return $this->puntuacion;
    }

    public function setPuntuacion(?int $puntuacion): self
    {
        $this->puntuacion = $puntuacion;

        return $this;
    }

    public function getTurno(): ?int
    {
        return $this->turno;
    }

    public function setTurno(int $turno): self
    {
        $this->turno = $turno;

        return $this;
    }

    public function getServicioEscogido(): ?ServiciosDisponibles
    {
        return $this->ServicioEscogido;
    }

    public function setServicioEscogido(?ServiciosDisponibles $ServicioEscogido): self
    {
        $this->ServicioEscogido = $ServicioEscogido;

        return $this;
    }

}
