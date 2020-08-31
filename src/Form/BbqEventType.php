<?php

namespace App\Form;

use App\Entity\BbqEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BbqEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('conjoint')
            ->add('nombreEnfants')
            ->add('present')
            ->add('salarie')
            ->remove('newBbq')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BbqEvent::class,
        ]);
    }
}
