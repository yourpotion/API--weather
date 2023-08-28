<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PassengerForSupervisorType extends AbstractType
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
            ->add('roles', ChoiceType::class, array(
                'choices' => [
                    '[ROLE_USER]' => 'ROLE_USER',
                    'ROLE_GATE_MANAGER' => 'ROLE_GATE_MANAGER',
                    'ROLE_CHECK_IN_MANAGER' => 'ROLE_CHECK_IN_MANAGER',
                    'ROLE_SUPERVISOR' => 'ROLE_SUPERVISOR'
                ],
                'multiple' => true, // Если нужно выбирать несколько ролей
                'expanded' => true, // Если нужно отображать выбор в виде радиокнопок или чекбоксов
            ))
            ->add('seatType', ChoiceType::class, [
                'choices' => [
                    'Yes' => null,
                    'No' => null
                ]
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
