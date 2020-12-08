<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class VideoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,[
                'label' => 'Titre de la vidéo',
                'attr' => ["placeholder" => "Lien youtube de la forme https://www.youtube.com/embed/ID"],
                'required' => true,
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Description',
                'attr' => ["placeholder" => "Décrivez l'intérêt de cette vidéo"],
                'required' => false,
            ])
            ->add('link', TextType::class,[
                'label' => 'Lien youtube',
                'attr' => ["placeholder" => "Lien youtube de la forme https://www.youtube.com/embed/ID"],
                'required' => true,
            ])
            ->add('date')
            ->add('save', SubmitType::class, ['label' => 'Valider'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
