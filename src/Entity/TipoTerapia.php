<?php

namespace App\Entity;

use App\Repository\TipoTerapiaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=TipoTerapiaRepository::class)
 * @ApiResource()
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
     * @ORM\ManyToOne(targetEntity=ServiciosDisponibles::class, inversedBy="tipoTerapia")
     * @ORM\JoinColumn(nullable=false)
     */
    private $servicio_escogido;

    public function __toString(){
        return $this->NombreTerapia;
    }

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

    public function getServicioEscogido(): ?ServiciosDisponibles
    {
        return $this->servicio_escogido;
    }

    public function setServicioEscogido(?ServiciosDisponibles $servicio_escogido): self
    {
        $this->servicio_escogido = $servicio_escogido;

        return $this;
    }
}


