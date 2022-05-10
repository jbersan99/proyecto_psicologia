<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('ID')
            ->hideOnForm(),
            TextField::new('Nombre')
            ->setRequired(true),
            TextField::new('Apellidos')
            ->setRequired(true),
            EmailField::new('Email')
            ->setRequired(true),
            NumberField::new('DNI')
            ->setRequired(true),
            NumberField::new('Telefono')
            ->setRequired(true),
            NumberField::new('Edad')
            ->setRequired(true),
            TextField::new('Localidad')
            ->setRequired(true),
            TextField::new('Password')
            ->setFormType(PasswordType::class)
            ->setRequired(true),
            ChoiceField::new('Roles')
                ->setLabel("Rol")
                ->setChoices([ 
                        'USER' => 'ROLE_USER',
                        'ADMIN' => 'ROLE_ADMIN',
                        ])      
                        ->allowMultipleChoices(true)
                        ->renderExpanded()
                        ->setRequired(true),
            
        ];
    }
}
