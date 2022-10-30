<?php

namespace App\Form;

use App\Entity\CPClassement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CPClassementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ClassementPhoto')
            ->add('NombrePoints')
            ->add('UpdatedAt')
            ->add('ConcoursPhotos')
            ->add('Image')
            ->add('User')
            ->add('Classement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CPClassement::class,
        ]);
    }
}
