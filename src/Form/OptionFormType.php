<?php

namespace App\Form;

use App\Entity\OptionLunchAndLuggage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OptionFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * 
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('lunch', ChoiceType::class, [
            'choices' => [
                'Yes' => true,
                'No' => false,
            ],
            'expanded' => true,
            'multiple' => false,
        ])->add('luggage', ChoiceType::class, [
            'choices' => [
                'Yes' => true,
                'No' => false,
            ],
            'expanded' => true,
            'multiple' => false,
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     * 
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

        ]);
    }
}
