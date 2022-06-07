<?php

namespace App\Controller;

use App\Entity\Cita;
use App\Entity\ServiciosDisponibles;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $citas = $doctrine->getRepository(Cita::class)->findAll();
        $usuarios = $doctrine->getRepository(User::class)->findAll();
        $psicologos_gabinetes = $doctrine->getRepository(ServiciosDisponibles::class)->findAll();

        return $this->render('index/index.html.twig', [
            'usuarios' => $usuarios,
            'psicologos_gabinetes' => $psicologos_gabinetes,
            'citas' => $citas
        ]);
    }
}
