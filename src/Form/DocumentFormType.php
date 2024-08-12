<?php

namespace App\Form;

use App\Entity\Document;
use App\Entity\Seance;
use App\Repository\SeanceRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
                'label' => 'Description associée au document : '
            ])
            ->add('path', FileType::class, [
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Fichier à télécharger : '
            ])
            ->add('seance', EntityType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Séance de rattachement :',
                'class' => Seance::class,
                'choice_label' => function (Seance $seance) {
                    $seanceNumber = $seance->getNumero();

                    if ($seanceNumber === 1000) {
                        return 'Séq. ' . $seance->getSequence()->getNumero() . ' / Projet';
                    } elseif ($seanceNumber === 1001) {
                        return 'Séq. ' . $seance->getSequence()->getNumero() . ' / Grammaire';
                    } else {
                        return 'Séq. ' . $seance->getSequence()->getNumero() . ' / Séance ' . $seanceNumber . ' - ' . $seance->getTitre();
                    }

                },
                'query_builder' => function (SeanceRepository $er) {
                    return $er->createQueryBuilder('s')
                              ->join('s.sequence', 'seq')
                              ->orderBy('seq.numero', 'ASC')
                              ->addOrderBy('s.numero', 'ASC');
                }
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
