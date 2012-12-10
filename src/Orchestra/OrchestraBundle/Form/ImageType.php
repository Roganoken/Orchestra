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
            ->add('dateCreation')
            ->add('url')
            ->add('taille')
            ->add('poids')
            ->add('logiciel')
            ->add('motCle')
            ->add('created')
            ->add('updated')
            ->add('isPortfolio')
            ->add('commentaire')
            ->add('user')
            ->add('media')
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
