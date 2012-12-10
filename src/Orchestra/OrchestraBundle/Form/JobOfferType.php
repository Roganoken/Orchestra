<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JobOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('start')
            ->add('duration')
            ->add('remuneration')
            ->add('visits')
            ->add('comment')
            ->add('active')
            ->add('deleted')
            ->add('created')
            ->add('updated')
            ->add('diploma')
            ->add('company')
            ->add('contract')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Orchestra\OrchestraBundle\Entity\JobOffer'
        ));
    }

    public function getName()
    {
        return 'orchestra_orchestrabundle_joboffertype';
    }
}
