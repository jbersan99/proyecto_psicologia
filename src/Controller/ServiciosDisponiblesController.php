<?php

namespace App\Controller;

use App\Entity\ServiciosDisponibles;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiciosDisponiblesController extends AbstractController
{
    /**
     * @Route("/show_servicios", name="show_servicios")
     */
    public function mostrar_barcos(ManagerRegistry $doctrine): Response
    {
        $servicios = $doctrine->getRepository(ServiciosDisponibles::class)->findAll();

        return $this->render('servicios_disponibles/index.html.twig', array(
            'servicios' => $servicios,
        ));
    }
}
