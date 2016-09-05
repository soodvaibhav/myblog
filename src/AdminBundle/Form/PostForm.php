<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['required' => true, 'error_bubbling' => true]);
        $builder
            ->add('content', TextareaType::class, ['required' => true, 'error_bubbling' => true]);
        $builder
            ->add('status', TextType::class, ['required' => true, 'error_bubbling' => true]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontendBundle\Entity\Post',
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ));
    }
}
