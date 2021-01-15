<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AjoutAuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('prenom', TextType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('dateNaissance', DateType::class, [
                'required' => true,
                'help' => 'Obligatoire',
                'years' => range(date('Y')-1500, date('Y')),
            ])
            ->add('dateDeces', DateType::class, [
                'required' => false,
                'years' => range(date('Y')-1500, date('Y')),
            ])
            ->add('bioCourte', TextType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('bioLongue', TextType::class, [
                'required' => false,
            ])
            ->add('oeuvresExt', TextType::class, [
                'required' => false,
            ])
            ->add('liensWeb', TextType::class, [
                'required' => false,
            ])
            ->add('image', FileType::class, array('label' => 'Fichier à télécharger'), [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('send', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}