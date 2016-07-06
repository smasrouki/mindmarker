<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', null, array(
                'attr' => array('class' => 'form-control', 'rows' => '10'),
            ))
            ->add('contentClass', 'choice', array(
                'choices' => array(
                    'panel-default' => 'Defaut',
                    'panel-primary' => 'Principal',
                    'panel-warning' => 'Important',
                    'panel-danger' => 'Danger',
                    'panel-success' => 'Succès',
                    'panel-info' => 'Info',
                ),
                'attr' => array('class' => 'form-control input-sm pull-right')
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Content',
            'csrf_protection' => false,
        ));
    }
}
