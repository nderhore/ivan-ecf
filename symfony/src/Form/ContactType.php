<?php

namespace App\Form;

use App\Entity\Contacts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { 
        $builder
            ->add('firstname', TextType::class, [
                'required' => true,
            ])                
            ->add('lastname', TextType::class, [
                'required' => true,
            ]) 
            ->add('email', TextType::class, [
                'required' => true,
            ])
            ->add('phone', TextType::class, [
                'required' => true,
            ]) 
            ->add('title', TextType::class, [
                'required' => true,
                'empty_data' => 'Voiture',
            ])
            ->add('message', TextareaType::class, [
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contacts::class,
        ]);
    }
}