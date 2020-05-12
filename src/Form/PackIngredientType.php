<?php

namespace App\Form;

use App\Entity\PackIngredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PackIngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('quantite', NumberType::class, [
                'scale' => 1,
                'attr' => array(
                    'min' => 0,
                    'max' => 1,
                    'step' => '.1',
                )
            ])
            ->add('unite', ChoiceType::class, [
                "choices"=> [
                    "g"=>"g",
                    "pcs"=> "pcs",
                    "kg"=>"kg",
                    "litre"=>"litre",
                    "cl"=>"cl",
                    "cas"=>"cas",
                    "verre"=>"verre"
                ]
            ])
            ->add('prix', NumberType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PackIngredient::class,
        ]);
    }
}
