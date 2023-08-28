<?php

namespace App\Form;

use App\Entity\Flight;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlightStaffFormType extends AbstractType
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
            ->add('departure', TextType::class, [
                'attr' => array(
                    'placeholder' => 'From...'
                )
            ])
            ->add('arrival', TextType::class, [
                'attr' => array(
                    'placeholder' => 'To...'
                )
            ])
            ->add('dateOfDeparture', DateType::class, [
                'attr' => array(
                    'placeholder' => 'When...'
                )
            ])
            ->add('dateOfArrival', DateType::class, [
                'attr' => array(
                    'placeholder' => 'When...'
                )
            ])
            ->add('timeOfDeparture', TimeType::class, [
                'attr' => array(
                    'placeholder' => 'When...'
                )
            ])
            ->add('timeOfArrival', TimeType::class, [
                'attr' => array(
                    'placeholder' => 'When...'
                )
            ])
            ->add('price', TextType::class, [
                'attr' => array(
                    'placeholder' => 'How much...'
                )
            ])
            ->add('howManyTickets', IntegerType::class, [
                'attr' => array(
                    'placeholder' => 'Quantity...'
                )
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
            'data_class' => Flight::class,
        ]);
    }
}
