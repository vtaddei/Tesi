<?php

namespace App\Form;

use App\Entity\PersonalData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class PersonalDataTypes extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonalData::class,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true
            ])
            ->add('surname', TextType::class, [
                'required' => true
            ])
            ->add('birthdate', BirthdayType::class, [
                'required' => true
            ])
            ->add('birthplace', TextType::class, [
                'required' => true
            ])
            ->add('gender', TextType::class, [
                'required' => true
            ])
            ->add('taxCode', TextType::class, [
                'required' => true
            ])
            ->add('disadvantageFlag', IntegerType::class, [
                'required' => true
            ])
            ->add('athletes', CollectionType::class, [
                'entry_type' => AthletesFormType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'required' => true,
            ])
            ->add('Salva', SubmitType::class, [
            ]);
    }


}