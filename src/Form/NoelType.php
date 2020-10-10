<?php

namespace App\Form;

use App\Entity\Cheques;
use App\Entity\Colis;
use App\Entity\Noel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('CreatedAt')
            ->remove('User')
            ->add('choixColis', EntityType::class, [
                'class' => Colis::class,
                'required' => true,
                'expanded'  => false,
                'multiple'  => false,
                'choice_label' => 'nomColis',
                'label' => 'Choisir votre colis',
                'placeholder' => 'Choisissez votre colis',
                'attr'      => array('class' => 'form-control')
                ])
            ->add('choixCheque',EntityType::class, [
                'class' => Cheques::class,
                'required' => true,
                'expanded'  => false,
                'multiple'  => false,
                'choice_label' => 'nomCheque',
                'placeholder' => 'Choissiez vos chèques cadeaux',
                'attr'      => array('class' => 'form-control')
            ])
            ->add('adresseMail', EmailType::class, [
                'label' => 'Indiquez votre adresse mail (obligatoire pour les e-cheques cadeaux)',
                'required' => false,
                'attr'  => array('class' => 'form-control')
                ])
            ->add('optin', CheckboxType::class, [
                'label' => "Je souhaite rececoir les informations de mon CSE ",
                'required' => false,
                'attr'  => array('class' => 'form-check-input')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Noel::class,
        ]);
    }
}
