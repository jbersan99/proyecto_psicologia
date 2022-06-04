<?php

namespace App\Controller;

use App\Entity\ServiciosDisponibles;
use App\Entity\TipoTerapia;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiciosDisponiblesController extends AbstractController
{
    /**
     * @Route("/show_servicios", name="show_servicios")
     */
    public function mostrar_servicios(ManagerRegistry $doctrine): Response
    {
        $servicios = $doctrine->getRepository(ServiciosDisponibles::class)->findAll();

        return $this->render('servicios_disponibles/index.html.twig', array(
            'servicios' => $servicios,
        ));
    }

    /**
     * @Route("/get_servicios/{name}", name="get_servicios")
     */
    public function get_servicios(string $name,  EntityManagerInterface $em): Response
    {
        $servicios_id = $em->getRepository(TipoTerapia::class)->findServiciosbyName($name);
        $servicio = new stdClass();

        foreach ($servicios_id as $valor) {
            $objeto_servicio = new stdClass();
            $objeto_servicio->id_servicio = $valor->getServicioEscogido()->getId();
            $objeto_servicio->nombre_servicio = $valor->getServicioEscogido()->getNombreServicio();
            $objeto_servicio->gabinete_consulta = $valor->getServicioEscogido()->getGabineteConsulta();
            $objeto_servicio->nombre_psicologo = $valor->getServicioEscogido()->getNombrePsicologo();

            $servicio->servicios_a[] = $objeto_servicio;
        }

        $servicios_disponibles = json_encode($servicio);

        return new Response($servicios_disponibles);
    }
}
