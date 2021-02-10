<?php

namespace App\Form;

use App\Entity\AmisTQF;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class AjoutAmisTQFType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom',TextType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('nom',TextType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('organisme',TextType::class, [
                'required' => false
            ])
            ->add('email',EmailType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('adrCP',TextType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('adrVille',TextType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('adrRueno',TextType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('commentaires',TextareaType::class, [
                'required' => false,
            ])
            ->add('send', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AmisTQF::class,
        ]);
    }
}
