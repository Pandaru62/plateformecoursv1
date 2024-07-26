<?php

namespace App\Form;

use App\Entity\Sequence;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SequenceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                    'min' => 0,
                    'max' => 100,
                ],
                'label' => 'Numéro de la séquence : '
            ])
            ->add('titre', TextType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Titre de la séquence : '
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Description de la séquence : '
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Image :'
            ])
            ->add('password', TextType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                ],
                'label' => 'Attribuer un mot de passe d\'accès : ',
                'required' => false,
                'mapped' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sequence::class,
        ]);
    }
}
