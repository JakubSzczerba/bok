<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Form;

use App\Entity\Application;
use App\Provider\StatusProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateStatusType extends AbstractType
{
    private StatusProvider $statusProvider;

    public function __construct(StatusProvider $statusProvider)
    {
        $this->statusProvider = $statusProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => $this->statusProvider->getStatus(),
                'label' => 'status: ',
                'choice_value' => function ($value) {
                    return $value;
                },
                'required' => false,
            ])
            ->add('information', InformationType::class, [
                'required' => false,
            ])
            ->add('save', SubmitType::class, [])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }

}