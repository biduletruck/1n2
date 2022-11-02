<?php

namespace App\Form;

use App\Entity\CPConcoursPhotos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CPConcoursPhotosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('Identifiant')
            ->add('OpenAt')
            ->add('ClosedAt')
            ->add('defaut')
            ->add('Classement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CPConcoursPhotos::class,
        ]);
    }
}
