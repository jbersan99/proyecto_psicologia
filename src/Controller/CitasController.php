<?php

namespace App\Controller;

use App\Entity\Cita;
use App\Entity\ServiciosDisponibles;
use App\Entity\TipoTerapia;
use App\Entity\User;
use App\Repository\TipoTerapiaRepository;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


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
    public function reservar_cita(EntityManagerInterface $em): Response
    {
        $citas[] = new Cita;

        $citas = $em->getRepository(Cita::class)->findAll();


        $reserva = new stdClass();

        foreach ($citas as $valor) {

            $objeto_fechas = new stdClass();
            $objeto_fechas->fecha = $valor->getFechaCita();
            $objeto_fechas->turno = $valor->getTurno();

            $reserva->fechas[] = $objeto_fechas;
        }

        $fechas_reservadas = json_encode($reserva);
        return new Response($fechas_reservadas);
    }

    /**
     * @Route("/comprobar_cita/{fecha}", name="comprobar_cita")
     */
    public function comprobar_cita(string $fecha, ManagerRegistry $doctrine): Response
    {
        $citas = $doctrine->getRepository(Cita::class)->comprobarCita($fecha);

        $cita = new stdClass();

        foreach ($citas as $valor) {
                $objeto_fechas = new stdClass();
                $objeto_fechas->fecha_cita = $valor->getFechaCita();
                $objeto_fechas->turno = $valor->getTurno();

                $cita->fechas[] = $objeto_fechas;
        }

        $fechas_reservadas = json_encode($cita);
        return new Response($fechas_reservadas);
    }

    /**                                                                                   
     * @Route("/reservar", name="reservar")
     */
    public function reserva(ManagerRegistry $doctrine, Request $request): Response
    {
        //if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {
            $user = new User();
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $cita = new Cita();

            $fecha_cita = $request->get('fecha_cita');
            $precio_cita = $request->get('precio_cita');

            $servicio_seleccionado = $request->get('servicio_escogido');
            $servicio = (int) $servicio_seleccionado;
            $servicio = $doctrine->getRepository(ServiciosDisponibles::class)->getServicio($servicio);
            
            $turno = $request->get('turno');

            $time = new \DateTime();

            $cita->setFechaCita(\DateTime::createFromFormat('Y-m-d', $fecha_cita));
            $cita->setPrecioCita($precio_cita);
            $cita->setCreacionCita($time);
            $cita->setUsuarioReserva($user);
            $cita->setServicioEscogido($servicio);
            $cita->setTurno($turno);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($cita);
            $entityManager->flush();


            $fechas_reservadas = json_encode($cita);
            return new Response($fechas_reservadas);

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


    

    /**
     * @Route("/get_servicios/{name}", name="get_servicios")
     */
    public function get_servicios(EntityManagerInterface $em,string $name): Response
    {
        $servicios_id = $em->getRepository(TipoTerapia::class)->getServicios($name);
        //$servicios = $em->getRepository(ServiciosDisponibles::class)->findBy($servicios_id);

        // $servicio = new stdClass();

        // foreach ($servicios_id as $valor) {
        //     var_dump($valor);
        //     // if($valor->getId() == $id){
        //     //     $objeto_servicio = new stdClass();
        //     //     $objeto_servicio->id_servicio = $valor->getId();
        //     //     $objeto_servicio->nombre_servicio = $valor->getNombreServicio();
        //     //     $objeto_servicio->gabinete_consulta = $valor->getGabineteConsulta();
        //     //     $objeto_servicio->nombre_psicologo = $valor->getNombrePsicologo();

        //     //     $servicio->servicios_a[] = $objeto_servicio;
        //     // }
        // }

        // $servicios_disponibles = json_encode($servicios_id);
        return new Response($servicios_id[0]);
    }


}
