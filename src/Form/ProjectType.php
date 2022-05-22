<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Collections\ArrayCollection;


class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('idContact', CollectionType::class, 

            [   'label' => false,
                'entry_type' => ContactType::class,
                'entry_options' => ['label' => false],
                //Permettre de rajouter des formulaires :
                'allow_add' => true,
                //Je ne sais pas encore pourquoi :
                'by_reference' => false,
                'allow_delete' => true,
                'prototype' => true,
            ]
            )

            ->add('title')
            ->add('abstract')
            ->add('acronyme')
            ->add('startDate')
            ->add('duration')
            ->add('type')
            ->add('website')
            ->add('objectives')
            // ->add('idRefProject')
            // ->add('idFundingProject')
            // ->add('idContact')

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
