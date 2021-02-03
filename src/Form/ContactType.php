<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('email',EmailType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('subject',TextType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('message',TextareaType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('send', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
