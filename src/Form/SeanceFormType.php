<?php

namespace App\Form;

use App\Entity\Seance;
use App\Entity\Sequence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class SeanceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder;

        $builder->add('numero', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                    'min' => 0,
                    'max' => 2000,
                ],
                'label' => 'Numéro de la séance : '
            ])
            ->add('titre', TextType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Titre de la séance : '
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Description de la séance : '
            ])
            ->add('sequence', EntityType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Séquence de rattachement :',
                'class' => Sequence::class,
                'choice_label' => function (Sequence $sequence) {
                    return $sequence->getNumero() . ' - ' . $sequence->getTitre();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seance::class,
        ]);
    }
}
