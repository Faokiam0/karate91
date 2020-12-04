<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,
            [
                'label' => 'Entrez votre adresse email'
            ])
            ->add('message', TextareaType::class,
            [
                'label' => 'Laissez nous un message'
            ])
            ->add('save', SubmitType::class,
            [
                'label' => 'Valider'
            ])
        ;
    }
}
