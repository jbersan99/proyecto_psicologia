<?php

namespace App\Entity;

use App\Repository\ForoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ForoRepository::class)
 */
class Foro
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
    private $comentario;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_creacion;

    /**
     * @ORM\Column(type="integer")
     */
    private $valoracion;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="comentarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario_comenta;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fecha_creacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fecha_creacion): self
    {
        $this->fecha_creacion = $fecha_creacion;

        return $this;
    }

    public function getValoracion(): ?int
    {
        return $this->valoracion;
    }

    public function setValoracion(int $valoracion): self
    {
        $this->valoracion = $valoracion;

        return $this;
    }

    public function getUsuarioComenta(): ?user
    {
        return $this->usuario_comenta;
    }

    public function setUsuarioComenta(?user $usuario_comenta): self
    {
        $this->usuario_comenta = $usuario_comenta;

        return $this;
    }
}
