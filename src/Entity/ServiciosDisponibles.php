<?php

namespace App\Entity;

use App\Repository\ServiciosDisponiblesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ORM\Entity(repositoryClass=ServiciosDisponiblesRepository::class)
 * @ApiResource()
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

    /**
     * @ORM\OneToMany(targetEntity=TipoTerapia::class, mappedBy="servicio_escogido")
     */
    private $tipoTerapia;

    public function __construct()
    {
        $this->tipoTerapia = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, TipoTerapia>
     */
    public function getTipoTerapia(): Collection
    {
        return $this->tipoTerapia;
    }

    public function addTipoTerapium(TipoTerapia $tipoTerapium): self
    {
        if (!$this->tipoTerapia->contains($tipoTerapium)) {
            $this->tipoTerapia[] = $tipoTerapium;
            $tipoTerapium->setServicioEscogido($this);
        }

        return $this;
    }

    public function removeTipoTerapium(TipoTerapia $tipoTerapium): self
    {
        if ($this->tipoTerapia->removeElement($tipoTerapium)) {
            // set the owning side to null (unless already changed)
            if ($tipoTerapium->getServicioEscogido() === $this) {
                $tipoTerapium->setServicioEscogido(null);
            }
        }

        return $this;
    }
}
