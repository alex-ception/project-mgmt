<?php

namespace ProjectMgmt\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChapterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Nom du chapitre',
                'attr'  => array(
                    'class' => 'form-control',
                ),
            ))
            ->add('order', null, array(
                'label' => 'Ordre',
                'attr'  => array(
                    'class' => 'form-control',
                ),
            ))
            ->add('content', 'afe_elastic_textarea', array(
                'label' => 'Contenu',
                'attr'  => array(
                    'class' => 'form-control',
                ),
            ))
            ->add('save', 'submit', array(
                'label' => 'Sauvegarder',
                'attr'  => array(
                    'class' => 'btn btn-default btn-primary',
                ),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectMgmt\Bundle\Entity\Chapter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'projectmgmt_bundle_chapter';
    }
}
