<?php

namespace App\Form;

use App\Entity\Biblio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use App\Entity\Type;
use App\Entity\Oeuvre;

class AjoutBiblioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('oeuvre', EntityType::class, [
            'class'     => Oeuvre::class,
            'choice_label' => 'titre',
            'label'     => 'L\'oeuvre associée',
            'required' => true,
            'help' => 'Obligatoire',
        ])
            ->add('prixTotal', MoneyType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('nbExemplaires', IntegerType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('type', EntityType::class, [
                'class'     => Type::class,
                'choice_label' => 'libelle',
                'label'     => 'Le type de tirage (Livres d\'artiste ou tirage de tête)',
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('statut', TextType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('note', TextType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
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
            'data_class' => Biblio::class,
        ]);
    }
}
