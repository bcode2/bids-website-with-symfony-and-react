<?php

namespace App\Form;

use App\Entity\Asset;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            TextType::class,
            ['label' => 'Nombre de la subasta']
        )->add(
            'price',
            TextType::class,
            ['label' => 'Precio']
        )->add(
            'description',
            TextareaType::class,
            ['label' => 'description']
        )->add(
            'endDate',
            DateType::class,
            [
                'widget' => 'choice',
            ]
        );

        $builder->get('endDate')->addModelTransformer(
            new CallbackTransformer(
                function ($value) {
                    if (!$value) {
                        return new \DateTime('now +1 month');
                    }

                    return $value;
                }, function ($value) {
                return $value;
            }
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Asset::class,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_product';
    }


}
