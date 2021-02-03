<?php

namespace App\Form;

use App\Entity\Oeuvre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Genre;
use App\Entity\Auteur;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ModifOeuvreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre', TextType::class, [
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('noteStatut', TextType::class, [
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('dimensions', TextType::class, [
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('isbn', TextType::class, [
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('nbPages', IntegerType::class, [
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('datePublication', DateType::class, [
            'required' => true,
            'help' => 'Obligatoire',
            'years' => range(date('Y')-1500, date('Y')),
        ])
        ->add('note', TextType::class, [
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('prix', MoneyType::class, [
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('description', CKEditorType::class, [
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('extrait', CKEditorType::class, [
            'required' => false,
        ])
        ->add('genre', EntityType::class, [
            'class'     => Genre::class,
            'choice_label' => 'libelle',
            'label'     => 'Le genre de l\'oeuvre (Si le genre souhaité ne se trouve pas dans cette liste, le rajouter dans ajoutGenre)',
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('auteurs', EntityType::class, [
            'class'     => Auteur::class,
            'choice_label' => 'nom',
            'label'     => 'Le ou les auteurs',
            'expanded'  => true,
            'multiple'  => true,
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('statut', CheckboxType::class, [
            'required' => false,
        ])
        ->add('codePP', TextType::class, [
            'required' => false,
        ])
        ->add('couverture', FileType::class, [
            'label' => 'Fichier à télécharger',
            'data_class' => null,
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('send', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Oeuvre::class,
        ]);
    }
}
