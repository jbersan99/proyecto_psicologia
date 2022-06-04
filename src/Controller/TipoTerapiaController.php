<?php

namespace App\Controller;

use App\Entity\TipoTerapia;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TipoTerapiaController extends AbstractController
{
    /**
     * @Route("/show_terapias", name="show_terapias")
     */
    public function mostrar_terapias(ManagerRegistry $doctrine): Response
    {
        $terapias = $doctrine->getRepository(TipoTerapia::class)->findAll();

        return $this->render('tipo_terapia/index.html.twig', array(
            'terapias' => $terapias,
        ));
    }

    /**
     * @Route("/get_terapias", name="get_terapias")
     */
    public function get_terapias(EntityManagerInterface $em): Response
    {
        $terapias = $em->getRepository(TipoTerapia::class)->findTerapias();

        $terapia = new stdClass();

        foreach ($terapias as $valor) {
            $objeto_terapia = new stdClass();
            $objeto_terapia->nombre_terapia = $valor["NombreTerapia"];

            $terapia->terapias_a[] = $objeto_terapia;
        }

        $terapias_disponibles = json_encode($terapia);
        return new Response($terapias_disponibles);
    }
}
