<?php

namespace App\Form;

use App\Entity\Halloween;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HalloweenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('createdAt')
            ->remove('finishedAt')
            ->add('Quest1', ChoiceType::class, array(
                'label' => '1)	En quelle année le film L’Exorciste est-il sorti sur la toile ? ',
                'choices' => array(
                    'a)	1973' => 1,
                    'b)	1974' => 0,
                    'c)	1975' => 0,
                ),
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('Quest2', ChoiceType::class, array(
                'label' => '2)	Dans Les Griffes de la Nuit de quelle couleur est le pull de Freddy ?',
                'choices' => array(
                    'a) rayé vert et bleu' => 0,
                    'b) rayé jaune et vert' => 0,
                    'c) rayé rouge et vert' => 1,
                ),
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('Quest3', ChoiceType::class, array(
                'label' => '3)	Qui est le réalisateur du film Shining ?',
                'choices' => array(
                    'a)	Ridley Scott' => 0,
                    'b)	Stephen King' => 0,
                    'c)	Stanley Kubrick' => 1,
                ),
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('Quest4', ChoiceType::class, array(
                'label' => '4)	Dans le film Psychose comment s’appelle le tueur ?',
                'choices' => array(
                    'a)	Alfred Hitchcock' => 0,
                    'b)	Norman Bates' => 0,
                    'c)	Anthony Perkins' => 1,
                ),
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('Quest5', ChoiceType::class, array(
                'label' => '5)	Combien de volet compte la série de films Alien ?',
                'choices' => array(
                    'a)	5' => 0,
                    'b)	6' => 1,
                    'c)	7' => 0,
                ),
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('Quest6', ChoiceType::class, array(
                'label' => '6)	Qui est l’actrice principale du film Halloween sorti en 2018 ?',
                'choices' => array(
                    'a)	Drew Barrymore' => 0,
                    'b)	Laurie Strode' => 0,
                    'c)	Jamie Lee Curtis' => 1,
                ),
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('Quest7', ChoiceType::class, array(
                'label' => '7)	Dans Scream comment s’appelle le personnage principal interprété par Neve Campbell ?',
                'choices' => array(
                    'a)	Sydney Prescott' => 0,
                    'b)	Sidney Prescot' => 0,
                    'c)	Sidney Prescott' => 1,
                ),
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('Quest8', ChoiceType::class, array(
                'label' => '8)	Qui est le réalisateur du film Jaws sorti dans les salle de cinéma en 1975 ?',
                'choices' => array(
                    'a)	Steven Spielberg' => 1,
                    'b)	James Cameron' => 0,
                    'c)	John Carpenter' => 0,
                ),
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('Quest9', ChoiceType::class, array(
                'label' => '9)	Quelle est la couleur de la chevelure du personnage de Carrie au bal du diable ?',
                'choices' => array(
                    'a) Brune' => 0,
                    'b) Rousse' => 1,
                    'c) Blonde' => 0,
                ),
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('Quest10', ChoiceType::class, array(
                'label' => '10)	Qui joue le rôle du Comte Dracula dans la version de Francis Ford Coppola ?',
                'choices' => array(
                    'a) Anthony Hopkins' => 0,
                    'b) Gary Oldman' => 1,
                    'c) Jack Nicholson' => 0,
                ),
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ))
            ->remove('User')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Halloween::class,
        ]);
    }
}
