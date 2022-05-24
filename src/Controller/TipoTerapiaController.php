<?php

namespace App\Controller;

use App\Entity\TipoTerapia;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TipoTerapiaController extends AbstractController
{
    /**
     * @Route("/show_terapias", name="show_terapias")
     */
    public function mostrar_barcos(ManagerRegistry $doctrine): Response
    {
        $terapias = $doctrine->getRepository(TipoTerapia::class)->findAll();

        return $this->render('tipo_terapia/index.html.twig', array(
            'terapias' => $terapias,
        ));
    }
}
