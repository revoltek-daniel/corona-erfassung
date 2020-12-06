<?php

namespace App\Form;

use App\Entity\ContactPerson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactPersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('salutation', ChoiceType::class, ['choices' => ['Herr' => 'mr', 'Frau' => 'mrs', 'Divers' => 'div']])
            ->add('firstname')
            ->add('lastname')
            ->add('street')
            ->add('streetnumber')
            ->add('zip')
            ->add('city')
            ->add('phone', TelType::class)
            ->add('email')
            ->add('tested')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactPerson::class,
        ]);
    }
}
