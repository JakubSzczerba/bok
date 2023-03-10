<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Form;

use App\Entity\Application;
use App\Provider\OrganizationProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ApplicationType extends AbstractType
{
    private OrganizationProvider $organizationProvider;

    public function __construct(OrganizationProvider $organizationProvider)
    {
        $this->organizationProvider = $organizationProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', TextType::class, [
                'label' => 'Temat: ',
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Treść: ',
            ])
            ->add('organization', ChoiceType::class, [
                'choices' => $this->organizationProvider->getOrganizations(),
                'label' => 'Jednostka organizacyjna: ',
                'choice_value' => function ($value) {
                    return $value;
                },
                'data' => 'shop_a',
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email: ',
                'required' => false,
            ])
            ->add('phone', NumberType::class, [
                'label' => 'Telefon: ',
                'required' => false,
            ])
            ->add('agreement', CheckboxType::class, [
                'label' => 'Zgoda: ',
                'required' => false,
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success', 'onchange' => 'IsEmpty()'],
            ])
        ;
        /*$builder->get('phone')->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                if(!empty($event->getData())) {
                    //dd($form->getParent()->get('agreement')->getConfig()->getRequired());
                    $form->getParent()->remove('agreement');
                    $form->getParent()->add('agreement', CheckboxType::class, [
                        'label' => 'Zgoda: ',
                        'required' => true,
                    ]);
                }
            }
        ); */
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }

}