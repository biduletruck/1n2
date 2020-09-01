<?php

namespace App\Form;

use App\Entity\BbqEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BbqEvent1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('present', ChoiceType::class, [
                'required' => true,
                'label'  => 'Je serai présent ?' ,
                'expanded'  => false,
                'multiple'  => false,
                'attr'      => array('class' => 'form-control'),
                'choices'  => [
                    'Oui' => 1,
                    'Non' => 0,
                ]
            ])

            ->add('conjoint', ChoiceType::class, [
                'required' => true,
                'label'  => 'Mon conjoint sera présent ?' ,
                'expanded'  => false,
                'multiple'  => false,
                'attr'      => array('class' => 'form-control'),
                'choices'  => [
                    'Oui' => 1,
                    'Non' => 0,
                ]
            ])

            ->add('nombreEnfants',IntegerType::class, [
                'required'  => true,
                'label' => 'Nombre d\'enfants ?',
                'attr'      => array(
                    'class' => 'form-control'
                )
            ])

            ->add('roller', ChoiceType::class, [
                'required' => true,
                'label'  => 'Je participe à l\'atelier Roller' ,
                'expanded'  => false,
                'multiple'  => false,
                'attr'      => array('class' => 'form-control'),
                'choices'  => [
                    'Oui' => 1,
                    'Non' => 0,
                ]
            ])

            ->add('foot', ChoiceType::class, [
                'required' => true,
                'label'  => 'Je participe à l\'atelier Foot' ,
                'expanded'  => false,
                'multiple'  => false,
                'attr'      => array('class' => 'form-control'),
                'choices'  => [
                    'Oui' => 1,
                    'Non' => 0,
                ]
            ])

            ->add('tennis', ChoiceType::class, [
                'required' => true,
                'label'  => 'Je participe à l\'atelier Tennis' ,
                'expanded'  => false,
                'multiple'  => false,
                'attr'      => array('class' => 'form-control'),
                'choices'  => [
                    'Oui' => 1,
                    'Non' => 0,
                ]
            ])
            ->remove('salarie')
            ->remove('reglement')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BbqEvent::class,
        ]);
    }
}
