<?php

namespace App\Form;

use App\Entity\ContactPerson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactPersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('street')
            ->add('streetnumber')
            ->add('zip')
            ->add('city')
            ->add('phone')
            ->add('email')
            ->add('contacted')
            ->add('contactDate')
            ->add('tested')
            ->add('salutation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactPerson::class,
        ]);
    }
}
