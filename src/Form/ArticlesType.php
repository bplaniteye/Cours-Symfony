<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('titre' , TextType::class, ['label' => 'Titre'])
        ->add('resume' , TextType::class, ['label' => 'Résumé'])
        ->add('contenu' , TextType::class, ['label' => 'Contenu'])
        ->add('date')
        ->add('image' , TextType::class, ['label' => 'Image']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
