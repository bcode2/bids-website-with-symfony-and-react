<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            TextType:: class,
            ['label' => 'Nombre', 'required' => true]
        )->add(
            'surname',
            TextType::class,
            ['label' => 'Apellidos']
        )->add(
                'email',
                EmailType:: class,
                ['label' => 'Correo Electrónico', 'required' => true,]
            )->add(
                'plainPassword',
                RepeatedType::class,
                [
                    'required' => true,
                    'type' => PasswordType::class,
                    'first_options' => ['label' => 'Contraseña'],
                    'second_options' => ['label' => 'Repita Contraseña'],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
            ]
        );
    }
}
