<?php

namespace App\Controller\Admin;

use App\Entity\Cita;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class CitaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cita::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->renderContentMaximized();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('ID')
            ->hideOnForm(),
            AssociationField::new('usuario_reserva')->setCrudController(UserCrudController::class),
            AssociationField::new('tipoTerapia_reserva')->setCrudController(TipoTerapiaCrudController::class),
            DateField::new('Fecha_Cita')
            ->setRequired(true)
            ->setFormat('dd MMMM yyyy hh:mm')
            ->setTimezone('Europe/Madrid'),
            NumberField::new('Turno')
            ->setRequired(true),
            NumberField::new('Precio_Cita')
            ->setRequired(true),
            TextField::new('Valoracion')
            ->setRequired(false),
            NumberField::new('Puntuacion')
            ->setRequired(false),
            DateField::new('Creacion_Cita')
            ->setRequired(true)
            ->setFormat('dd MMMM yyyy hh:mm')
            ->setTimezone('Europe/Madrid'),
            
            

        ];
}
}
