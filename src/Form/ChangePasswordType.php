<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldpassword', PasswordType::class,
            [
                'label' => 'Entrez votre ancien mot de passe'
            ])
            ->add('newpassword', PasswordType::class,
            [
                'label' => 'Entrez votre nouveau mot de passe'
            ])
            ->add('newpassword2', PasswordType::class,
            [
                'label' => 'Entrez votre nouveau mot de passe'
            ])
            ->add('captcha', CaptchaType::class,
            [
                'label' => 'Vérification Captcha  '
            ]);
        ;
    }
}
