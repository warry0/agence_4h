<?php

namespace App\Form;

use App\Entity\PropertyShearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice', IntegerType::class,[
                'required'=>false,
                'label'=>false,
                'attr'=> [
                    'placeholder' => 'Prix max'
                ]
            ])
        
            ->add('minSurface',IntegerType::class,[
                'required'=>false,
                'label'=>false,
                'attr'=> [
                    'placeholder' => 'Surface minimale'
                ]
            ])
        ;
    }

    public function getBlockPrefix()
    {
        return '';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertyShearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
}
