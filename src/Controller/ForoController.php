<?php

namespace App\Controller;

use App\Entity\Cita;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForoController extends AbstractController
{
    /**
     * @Route("/foro", name="app_foro")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $citas = $doctrine->getRepository(Cita::class)->findAll();

        return $this->render('foro/index.html.twig', array(
            'citas' => $citas,
        ));
    }
}
