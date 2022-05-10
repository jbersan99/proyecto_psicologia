<?php

namespace App\Controller\Admin;

use App\Entity\ServiciosDisponibles;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ServiciosDisponiblesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ServiciosDisponibles::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('ID')
            ->hideOnForm(),
            TextField::new('Nombre_Servicio')
            ->setRequired(true),
            TextField::new('Gabinete_Consulta')
            ->setRequired(true),
            TextField::new('Nombre_Psicologo')
            ->setRequired(true),

        ];
}
}
