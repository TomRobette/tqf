<?php

namespace App\Form;

use App\Entity\Apropos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ModifAproposType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texte', CKEditorType::class, [
                'required' => true,
                'help' => 'Obligatoire',
            ])
            ->add('send', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apropos::class,
        ]);
    }
}
