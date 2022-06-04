<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cita;
use App\Entity\ServiciosDisponibles;
use App\Entity\TipoTerapia;
use App\Entity\User;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return parent::index();
        }if ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_index');
        }else{
            return $this->redirectToRoute('app_index');
        }
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Proyecto Psicología')
            ->setFaviconPath('images/psico.png')
            ->setTranslationDomain('my-custom-domain')
            ->setTextDirection('ltr')
            ->renderContentMaximized()
            ->renderSidebarMinimized()
            ->disableUrlSignatures()
            ->generateRelativeUrls();
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::section('Cita'),
            MenuItem::linkToCrud('Cita', 'fa fa-book', Cita::class),

            MenuItem::section('Terapias'),
            MenuItem::linkToCrud('Terapias', 'fa fa-brain', TipoTerapia::class),

            MenuItem::section('Servicios'),
            MenuItem::linkToCrud('Servicios', 'fa fa-taxi', ServiciosDisponibles::class),

            MenuItem::section('Users'),
            MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
        ];
    }
}
