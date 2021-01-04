<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Captcha', CaptchaType::class)
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Entrez votre nouveau mot de passe',
                        ]),
                        new Length([
                            'min' => 7,
                            'minMessage' => 'Votre mot de passe doit avoir une longueure de plus de 7 caractères',
                            // max length allowed by Symfony for security reasons
                            'max' => 17,
                        ]),
                    ],
                    'label' => 'Entrez votre nouveau mot de passe',
                ],
                'second_options' => [
                    'label' => 'Entrez votre nouveau mot de passe',
                ],
                'invalid_message' => 'Vous devez entrer le même mot de passe',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
