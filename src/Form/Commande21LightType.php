<?php

namespace App\Form;

use App\Entity\Cheque21;
use App\Entity\Colis;
use App\Entity\Commande21;
use App\Entity\Package21;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Commande21LightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('createdAt')
            ->add('emailSalarie', EmailType::class, [
                'label' => 'Votre adresse mail personnelle - obligatoire pour les E-CHÈQUE ',
                'required' => false,
                'attr' => array('class' => 'form-control')
            ])
            ->remove('salarie')
            ->add('package', EntityType::class, [
                    'class' => Package21::class,
                    'required' => true,
                    'expanded'  => false,
                    'multiple'  => false,
                    'choice_label' => 'titlePackage',
                    'label' => 'Choisir votre colis',
                    'placeholder' => 'Choisissez votre colis',
                    'attr'      => array('class' => 'form-control')
                ])
            ->add('cheque', EntityType::class, [
                'class' => Cheque21::class,
                'required' => true,
                'expanded'  => false,
                'multiple'  => false,
                'choice_label' => 'titleCheque',
                'label' => 'Choisir votre type de chèque',
                'placeholder' => 'Choisir votre type de chèque',
                'attr'      => array('class' => 'form-control'),
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('c')
                        ->andWhere('c.profile = false')
                        ;
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande21::class,
        ]);
    }
}
