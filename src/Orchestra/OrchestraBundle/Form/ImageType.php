<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('descriptif')
            ->add('dateCreation', 'date', array(
                'widget' => 'choice',
                'years' => range(date('Y') - 30, date('Y')),
                'label' => 'Date de création',
                ))
            ->add('logiciel')
            ->add('media', 'entity', array(
                 'class' => 'OrchestraOrchestraBundle:Media',
                 'property' => 'intitule',
                 'empty_value' => 'Choisissez',
                 'label' => 'Média',
                ))
            ->add('file', 'file', array('label' => 'Image'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Orchestra\OrchestraBundle\Entity\Image'
        ));
    }

    public function getName()
    {
        return 'orchestra_orchestrabundle_imagetype';
    }
}
