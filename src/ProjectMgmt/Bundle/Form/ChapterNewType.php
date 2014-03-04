<?php

namespace ProjectMgmt\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChapterNewType extends AbstractType
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
            ->add('author', 'entity', array(
                'class'         => 'ProjectMgmt\Bundle\Entity\User',
                'property'      => 'username',
                'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('u')->orderBy('u.username', 'ASC');
                },
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
        return 'projectmgmt_bundle_chapter_new';
    }
}
