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
     * @Route("/get_terapias", name="get_terapias")
     */
    public function get_terapias(EntityManagerInterface $em): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {
            $terapias = $em->getRepository(TipoTerapia::class)->findTerapias();

            $terapia = new stdClass();

            foreach ($terapias as $valor) {
                $objeto_terapia = new stdClass();
                $objeto_terapia->nombre_terapia = $valor["NombreTerapia"];

                $terapia->terapias_a[] = $objeto_terapia;
            }

            $terapias_disponibles = json_encode($terapia);
            return new Response($terapias_disponibles);
        } else {
            return new Response("No tienes permisos para entrar aqui");
        }
    }
}
