<?php

namespace App\Entity;

use App\Repository\ServiciosDisponiblesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiciosDisponiblesRepository::class)
 */
class ServiciosDisponibles
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
    private $NombreServicio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $GabineteConsulta;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NombrePsicologo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreServicio(): ?string
    {
        return $this->NombreServicio;
    }

    public function setNombreServicio(string $NombreServicio): self
    {
        $this->NombreServicio = $NombreServicio;

        return $this;
    }

    public function getGabineteConsulta(): ?string
    {
        return $this->GabineteConsulta;
    }

    public function setGabineteConsulta(string $GabineteConsulta): self
    {
        $this->GabineteConsulta = $GabineteConsulta;

        return $this;
    }

    public function getNombrePsicologo(): ?string
    {
        return $this->NombrePsicologo;
    }

    public function setNombrePsicologo(string $NombrePsicologo): self
    {
        $this->NombrePsicologo = $NombrePsicologo;

        return $this;
    }

}
