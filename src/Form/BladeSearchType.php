<?php

namespace App\Form;

use App\Entity\Element;
use App\Entity\Skill;
use App\Entity\Weapon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BladeSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, array(
                'required'     => false,
                'multiple'     => true,
                'choices' => array(
                    'Masculin' => 'M',
                    'Féminin'  => 'F',
                    'Bête'     => 'B'
                ),
                'label_format' => 'blade.fields.%name%',
                'choice_translation_domain' => false,
            ))
            ->add('element', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                'required'     => false,
                'class'        => Element::class,
                'multiple'     => true,
                'choice_label' => 'name',
                'choice_attr'  => function ($element) {
                    return array('style' => 'background-color:' . $element->getColor());
                },
                'expanded' => true,
                'label_format' => 'blade.fields.%name%',
                'attr' => array('class' => 'form-check-inline'),
            ))
            ->add('strength', null, array(
                'required'     => false,
                'label_format' => 'blade.fields.%name%',
            ))
//             ->add('trustLevel', ChoiceType::class, array(
//                 'choices' => array_combine(range('E', 'A', -1), range(1, 5)),
//                 'label_format' => 'blade.fields.%name%',
//                 'choice_translation_domain' => false,
//             ))
//             ->add('rareness', null, array(
//                 'label_format' => 'blade.fields.%name%',
//             ))
            ->add('weapon', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                'required'     => false,
                'class'        => Weapon::class,
                'multiple'     => true,
                'label_format' => 'blade.fields.%name%',
                'choice_label' => 'name',
            ))
//             ->add('class', ChoiceType::class, array(
//                 'required'     => true,
//                 'choices' => array(
//                     'blade.class.ATK.long'  => 'ATK',
//                     'blade.class.TNK.long'  => 'TNK',
//                     'blade.class.HLR.long'  => 'HLR',
//                 ),
//                 'label_format' => 'blade.fields.%name%',
//             ))
            ->add('skills', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                'required'     => false,
                'class'        => Skill::class,
                'multiple'     => true,
                'choice_label' => 'name',
                'label_format' => 'blade.fields.%name%',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'method' => 'GET',
        ]);
    }
}
