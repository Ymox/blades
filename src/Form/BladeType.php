<?php

namespace App\Form;

use App\Entity\Blade;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BladeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label_format' => 'blade.fields.%name%',
            ))
            ->add('gender', ChoiceType::class, array(
                'required'     => true,
                'choices' => array(
                    'blade.gender.M.long' => 'M',
                    'blade.gender.F.long' => 'F',
                    'blade.gender.B.long' => 'B',
                ),
                'label_format' => 'blade.fields.%name%',
            ))
            ->add('element', null, array(
                'required'     => true,
                'choice_label' => 'name',
                'choice_attr'  => function ($element) {
                    return array('style' => 'background-color:' . $element->getColor());
                },
                'expanded' => true,
                'label_format' => 'blade.fields.%name%',
                'attr' => array('class' => 'form-check-inline'),
            ))
            ->add('driver', null, array(
                'required'     => true,
                'label_format' => 'blade.fields.%name%',
                'choice_label' => 'name',
            ))
            ->add('trustLevel', ChoiceType::class, array(
                'choices' => array_combine(range('E', 'A', -1), range(1, 5)) + [
                    'S' => 6,
                    'S1' => 7,
                    'S2' => 8,
                    'S3' => 9,
                    'S4' => 10,
                    'S5' => 11,
                    'S6' => 12,
                    'S7' => 13,
                    'S8' => 14,
                    'S9' => 15,
                    'S+' => 16,
                ],
                'label_format' => 'blade.fields.%name%',
                'choice_translation_domain' => false,
            ))
            ->add('strength', null, array(
                'label_format' => 'blade.fields.%name%',
            ))
            ->add('rareness', null, array(
                'label_format' => 'blade.fields.%name%',
            ))
            ->add('weapon', null, array(
                'required'     => true,
                'label_format' => 'blade.fields.%name%',
                'choice_label' => 'name',
            ))
            ->add('class', ChoiceType::class, array(
                'required'     => true,
                'choices' => array(
                    'blade.class.ATK.long'  => 'ATK',
                    'blade.class.TNK.long'  => 'TNK',
                    'blade.class.HLR.long'  => 'HLR',
                ),
                'label_format' => 'blade.fields.%name%',
            ))
            ->add('skills', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, array(
                'entry_type'   => SkillLevelType::class,
                'prototype'    => true,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label_format' => 'blade.fields.%name%',
                'entry_options' => array(
                    'label' => false,
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Blade::class,
        ]);
    }
}
