<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Student;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)

            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'Male' => 'male',
                    'Female' => 'female',
                ]
            ])

            ->add('class', ChoiceType::class, [
                'choices'  => [
                    'LKG' => 'lkg',
                    'UKG' => 'ukg',
                    'Nursery' => 'nursery',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10'
                ]
            ])

            ->add('fathersName', TextType::class)
            ->add('mothersName', TextType::class)

            ->add('dob', DateType::class, [
                 'widget' => 'single_text',
            ])

            ->add('joined', DateType::class, [
                 'widget' => 'single_text',
            ])

            ->add('active', ChoiceType::class, [
                'choices'  => [
                    'Yes' => true,
                    'No' => false,
                ]
            ])

            ->add('familyType', ChoiceType::class, [
                'choices'  => [
                    'Nuclear' => 'nuclear',
                    'Joint' => 'joint',
                ]
            ])

            ->add('address', TextareaType::class)
            ->add('parentsOccupation', TextType::class)
            ->add('parentsIncome', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Student::class,
        ));
    }
}
