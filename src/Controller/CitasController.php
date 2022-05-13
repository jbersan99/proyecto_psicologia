<?php

namespace App\Controller;

use App\Entity\Cita;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CitasController extends AbstractController
{
    /**
     * @Route("/citas", name="app_citas")
     */
    public function index(): Response
    {
        return $this->render('citas/index.html.twig', [
            'controller_name' => 'CitasController',
        ]);
    }

    /**
     * @Route("/reservar_cita", name="reservar_cita")
     */
    public function reservar_barco(EntityManagerInterface $em): Response
    {
        $citas[] = new Cita;

        $citas = $em->getRepository(Cita::class)->findAll();

        $reserva = new stdClass();

        foreach ($citas as $valor) {

            $objeto_fechas = new stdClass();
            $objeto_fechas->id = $valor->getTurno();
            $objeto_fechas->fecha_inicio = $valor->getFechaCita();

            $reserva->fechas[] = $objeto_fechas;
        }

        $fechas_reservadas = json_encode($reserva);
        return new Response($fechas_reservadas);
    }
}
