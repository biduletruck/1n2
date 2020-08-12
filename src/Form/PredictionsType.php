<?php

namespace App\Form;

use App\Entity\Companies;
use App\Entity\Matches;
use App\Entity\Predictions;
use App\Entity\Victories;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PredictionsType extends AbstractType
{
//    public function buildForm(FormBuilderInterface $builder, array $options)
//    {
//        $builder
//            ->add('CreatedAt')
//            ->add('Predict')
//            ->add('HomeResult')
//            ->add('VisitorResult')
//            ->add('Game')
//            ->add('User')
//        ;
//    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('CreatedAt')
            ->remove('Game')
            ->add('Predict', EntityType::class, array(
                'mapped' => true,
                'class'   => Victories::class,
                'choice_label' => false,
                'label' => false,
                'attr'      => array('class' => 'form-control'),

                'expanded' => true,
            ))
            ->add('HomeResult', NumberType::class, array(
                'required' => true,
                'label' => 'Nombre de supports',
                'attr'      => array('class' => 'form-control')

            ))
            ->add('VisitorResult', TextType::class, array(
                'required' => true,
                'label' => 'Nombre de supports',
                'attr'      => array('class' => 'form-control')

            ))

            ->remove('User')
        ;
    }






    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Predictions::class,
        ]);
    }
}
