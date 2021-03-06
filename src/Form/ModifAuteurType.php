<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ModifAuteurType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom', TextType::class, [
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('caractere', TextType::class, [
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
        ->add('bioCourte', CKEditorType::class, [
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('bioLongue', CKEditorType::class, [
            'required' => false,
        ])
        ->add('oeuvresExt', CKEditorType::class, [
            'required' => false,
        ])
        ->add('liensWeb', CKEditorType::class, [
            'required' => false,
        ])
        ->add('imageFile', VichImageType::class, [
            'required' => true,
            'help' => 'Obligatoire',
            'allow_delete' => true,
            'delete_label' => 'Supprimer l\'image',
            'download_label' => 'Télécharger l\'image',
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
