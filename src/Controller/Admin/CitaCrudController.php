<?php

namespace App\Controller\Admin;

use App\Entity\Cita;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
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
            DateField::new('Fecha_Cita')
            ->setRequired(true),
            DateTimeField::new('Hora_Cita')
            ->setRequired(true),
            NumberField::new('Precio_Cita')
            ->setRequired(true),
            DateField::new('Creacion_Cita')
            ->hideOnForm(),
            TextField::new('Valoracion')
            ->setRequired(true),
            NumberField::new('Puntuacion')
            ->setRequired(true),
            AssociationField::new('tipoTerapia_reserva')->setCrudController(TipoTerapiaCrudController::class),
            AssociationField::new('usuario')->setCrudController(UserCrudController::class),

        ];
}
}
