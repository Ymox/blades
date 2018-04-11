<?php

namespace App\Form;

use App\Entity\Driver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DriverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label_format' => 'driver.fields.%name%',
            ))
            ->add('blades', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, array(
                'entry_type'    => BladeType::class,
                'prototype'     => true,
                'allow_add'     => true,
                'allow_delete'  => true,
                'by_reference'  => false,
                'entry_options' => array(
                    'label' => false,
                ),
                'label_format' => 'driver.fields.%name%',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Driver::class,
        ]);
    }
}
