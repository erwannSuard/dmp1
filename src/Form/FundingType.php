<?php

namespace App\Form;
use App\Entity\Contact;
use App\Entity\Funding;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
class FundingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('grantFunding', NumberType::class)
            ->add('idContactFunding', EntityType::class, 
            [
                'label' => 'Funder',
                'class' => Contact::class,
                'choice_label' => 'lastName',
                'multiple' => false,
                'expanded' => false,
                'required' => true,
                //Rajouté car erreur : Expected argument of type "?App\Entity\Contact", "Doctrine\Common\Collections\ArrayCollection" given at property path "idContactFunding".
                // 'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Funding::class,
        ]);
    }
}
