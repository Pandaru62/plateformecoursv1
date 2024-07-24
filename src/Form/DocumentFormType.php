<?php

namespace App\Form;

use App\Entity\Document;
use App\Entity\Seance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class DocumentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Type de fichier : ',
                'choices'  => [
                    'PDF' => 'pdf',
                    'Image' => 'image',
                    'Lien' => 'lien',
                    'Vidéo' => 'video',
                    'Autre' => 'autre',
                ],
            ])
            ->add('titre', TextType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Titre du document : '
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Description associé au document : '
            ])
            ->add('path', TextType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Lien du fichier : '
            ])
            ->add('seance', EntityType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Séance de rattachement :',
                'class' => Seance::class,
                'choice_label' => function (Seance $seance) {
                    return 'Séquence ' . $seance->getSequence()->getNumero() . ' / Séance ' . $seance->getNumero() . ' - ' . $seance->getTitre();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
