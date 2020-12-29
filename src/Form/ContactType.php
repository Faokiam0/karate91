<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class,
            [
                'label' => 'Entrez votre Nom'
            ])
            ->add('email', EmailType::class,
            [
                'label' => 'Entrez votre adresse email'
            ])
            ->add('message', TextareaType::class,
            [
                'label' => 'Laissez nous un message'
            ])
            ->add('captcha', CaptchaType::class)
            ->add('save', SubmitType::class,
            [
                'label' => 'Valider'
            ])
        ;
    }
}
