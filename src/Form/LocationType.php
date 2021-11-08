<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date')
            ->add('titre')
            ->add('categorie')
            ->add('image')
            ->add('description')
            ->add('adresse')
            ->add('valeur')
            ->add('adresse')
            ->add('accessibility') 
            ->add('status') 
            ->add('a_la_une') ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
