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
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class WorkPackageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder


            //SELECT
            ->add('idContact', EntityType::class, 
            [
                'label' => 'Work package leader',
                'class' => Contact::class,
                'choice_label' => 'lastName',
                'multiple' => true,
                'expanded' => false,
                'required' => true,

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
            
            
            //->add('idRefProject')

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
