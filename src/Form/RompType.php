<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Romp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RompType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('identifier', TextType::class)
            ->add('submissionDate')
            ->add('version', TextType::class)
            ->add('deliverable', TextType::class)
            ->add('licence', TextType::class)
            // ->add('idProjectRomp')
            //SELECT
            ->add('idContactRomp', EntityType::class, 
            [
                'label' => 'Romp Manager',
                'class' => Contact::class,
                'choice_label' => 'lastName',
                'multiple' => false,
                'expanded' => false,
                'required' => true,
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Romp::class,
        ]);
    }
}
