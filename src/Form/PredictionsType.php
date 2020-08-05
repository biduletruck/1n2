<?php

namespace App\Form;

use App\Entity\Companies;
use App\Entity\Matches;
use App\Entity\Predictions;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('Predict', ChoiceType::class, array(
                'mapped' => true,
                'required' => true,
                'label' => 'Qui selon vous gagnera le match ?',
                'choice_label' => function ($choice, $key, $value) {
                    if (true === $choice) {
                        return 'Definitely!';
                    }
                    return $key;
                },
                'choices' => array(
                    'Victoire Home'     => 1,
                    'Match null'        => 0,
                    'Victoire Visitor'  => 2,
                ),
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('HomeResult')
            ->add('VisitorResult')

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
