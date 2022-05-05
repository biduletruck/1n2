<?php

namespace App\Form;

use App\Entity\Ancv2022;
use App\Entity\Ancv2022commande;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ancv2022commandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->remove('CreatedAt')
            ->add('Cheque',EntityType::class, [
                'class' => Ancv2022::class,
//                'placeholder' => 'Name',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('a')
                        ->andWhere('a.Ancien <= 182 ')
                        ->orderBy('a.id', 'ASC')
                        ;
                }
            ])
            ->remove('User')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ancv2022commande::class,
        ]);
    }
}
