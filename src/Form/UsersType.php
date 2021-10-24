<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'attr'      => array('class' => 'form-control')
            ])
            ->add('nom', TextType::class, [
                'attr'      => array('class' => 'form-control')
            ])
            ->remove('password', PasswordType::class, [
                'required' => false,
                'attr'      => array('class' => 'form-control')
            ])

            ->add('roles', ChoiceType::class, array(
                'label'  => 'Droit de l\'utilisateur' ,
                'expanded'  => true,
                'multiple'  => true,
                'attr'      => array('class' => 'form-check'),
                'choices'  => [
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                    'SuperAdministrateur' => 'ROLE_SUPERADMIN'
                ]
            ))
            ->add('dateEntree', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr'      => array('class' => 'form-control')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
