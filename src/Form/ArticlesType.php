<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('titre' , TextType::class, ['label' => 'Titre ' , 'required' => true])
        ->add('resume' , TextType::class, ['label' => 'Résumé ', 'required' => true])
        ->add('contenu' , TextType::class, ['label' => 'Contenu ', 'required' => true])
        ->add('date', DateType::class , ['label' => 'Date '])
        ->add('image' , TextType::class, ['label' => 'Image ', 'required' => true])
        ->add('Enregistrer' , SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
