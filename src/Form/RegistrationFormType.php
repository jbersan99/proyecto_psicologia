<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduce tu contraseña',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Tu contraseña debe ser minimo de {{ limit }} caracteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('nombre', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduce tu nombre',
                    ])
                ],
            ])
            ->add('apellidos', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduce tus apellidos',
                    ])
                ],
            ])
            ->add('dni', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduce tu dni',
                    ])
                ],
            ])
            ->add('telefono', NumberType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduce tu telefono',
                    ])
                ],
            ])
            ->add('edad', NumberType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduce tu edad',
                    ])
                ],
            ])
            ->add('localidad', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduce tu localidad',
                    ])
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Debes de estar de acuerdo con los terminos',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
