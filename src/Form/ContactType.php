<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeContact', HiddenType::class,[
                'data' => 'Person'
            ])
            ->add('lastName', TextType::class,[
                'label' => 'Last Name : '
            ])
            ->add('firstName', TextType::class,[
                'label' => 'First Name : '
            ])
            ->add('mail', TextType::class,[
                'label' => 'Mail : '
            ])
            ->add('affiliation', TextType::class,[
                'label' => 'Affiliation : '
            ])
            ->add('identifier', TextType::class,[
                'label' => 'Identifier : '
            ])
            // ->add('idProject', TextType::class,[
            //     'label' => 'Project ID : '
            // ])

            // ->add('save', SubmitType::class, [
            //     'label' => 'Save task'
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
