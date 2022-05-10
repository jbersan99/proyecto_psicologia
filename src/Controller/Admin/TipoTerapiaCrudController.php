<?php

namespace App\Controller\Admin;

use App\Entity\TipoTerapia;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class TipoTerapiaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TipoTerapia::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('ID')
            ->hideOnForm(),
            TextField::new('Nombre_Terapia')
            ->setRequired(true),
            AssociationField::new('servicio_escogido')->setCrudController(ServiciosDisponiblesCrudController::class)

        ];
}
}
