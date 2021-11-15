<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\ChoiceList\ChoiceList;

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
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Apple' => 1,
                    'Banana' => 2,
                    'Durian' => 3
                ],
                'choice_attr' => [
                    'Apple' => ['data-color' => 'Red'],
                    'Banana' => ['data-color' => 'Yellow'],
                    'Durian' => ['data-color' => 'Green']
                    ]
            ])
            ->add('a_la_une') ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
