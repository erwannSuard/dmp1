<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeContact', ChoiceType::class,[
                'choices' => [
                    'Organization' => 'Organization',
                    'Person' => 'Person',
                ]
            ])
            ->add('lastName', TextType::class)
            ->add('firstName', TextType::class)
            ->add('mail', TextType::class)
            ->add('affiliation', TextType::class)
            ->add('identifier', TextType::class)
            ->add('idProject', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
