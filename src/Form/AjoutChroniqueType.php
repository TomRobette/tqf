<?php

namespace App\Form;

use App\Entity\Chronique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class AjoutChroniqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('texte', CKEditorType::class, [
            'required' => true,
            'help' => 'Obligatoire',
        ])
        ->add('date', DateType::class, [
            'required' => true,
            'help' => 'Obligatoire',
            'years' => range(date('Y')-2, date('Y')),
        ])
        ->add('send', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chronique::class,
        ]);
    }
}
