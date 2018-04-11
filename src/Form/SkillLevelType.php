<?php

namespace App\Form;

use App\Entity\SkillLevel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class SkillLevelType extends AbstractType
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('skill', null, array(
                'label_format' => 'skill_level.fields.%name%',
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'addable',
                    'data-uri' => $this->router->generate('skill_new'),
                ),
            ))
            ->add('level', null, array(
                'label_format' => 'skill_level.fields.%name%',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SkillLevel::class,
        ]);
    }
}
