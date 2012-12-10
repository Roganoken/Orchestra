<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address1')
            ->add('address2')
            ->add('address3')
            ->add('other')
            ->add('phone1')
            ->add('phone2')
            ->add('fax')
            ->add('isActive')
            ->add('isDeleted')
            ->add('created')
            ->add('updated')
            ->add('city')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Orchestra\OrchestraBundle\Entity\Address'
        ));
    }

    public function getName()
    {
        return 'orchestra_orchestrabundle_addresstype';
    }
}
