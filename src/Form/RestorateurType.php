<?php

namespace App\Form;

use App\Entity\Restorateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestorateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('username')
            ->add('password')
            ->add('code_TVA')
            ->add('cin')
            ->add('adresse')
            ->add('tel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restorateur::class,
        ]);
    }
}
