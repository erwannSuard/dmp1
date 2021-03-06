<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Form\WorkPackageType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('idFundingProject', CollectionType::class, 
            [
                'label' => false,
                'entry_type' => FundingType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                // 'by_reference' => false,
                'prototype' => true,
                'mapped' => false,
                'prototype_name' => 'project',
            ])
            
           
            ->add('idContact', EntityType::class, 
            [
                'label' => 'Project coordinator',
                'class' => Contact::class,
                'choice_label' => 'lastName',
                //changé
                'multiple' => false,
                'expanded' => false,
                'required' => true,
                //Rajouté
                'mapped' => false,

            ])

            ->add('title', TextType::class,[
                'label' => 'Title : '
            ])
            ->add('abstract', TextType::class,[
                'label' => 'Abstract : '
            ])
            ->add('acronyme', TextType::class,[
                'label' => 'Acronyme : '
            ])
            ->add('startDate')
            ->add('duration')
            ->add('type', TextType::class,[
                'label' => 'Type : '
            ])
            ->add('website', TextType::class,[
                'label' => 'Website : '
            ])
            ->add('objectives', TextAreaType::class,[
                'label' => 'Objectives : '
            ])

            ->add('idRefProject', CollectionType::class, 

            [   'label' => false,
                'entry_type' => WorkPackageType::class,
                'entry_options' => ['label' => false],
                //Permettre de rajouter des formulaires :
                'allow_add' => true,

                //Pour ne pas lier le champ à l'objet
                'mapped' => false,
                //Je ne sais pas encore pourquoi :
                'by_reference' => true,
                'allow_delete' => true,
                'prototype' => true,
            ]
            )


            ->add('save', SubmitType::class, [
                'label' => 'Save project'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
