<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu')
            ->add('toPersonneId', 'entity', array(
                     'class' => 'OrchestraOrchestraBundle:User',
                     'property' => 'label',
                     'label' => 'Destinataire'
                    ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Orchestra\OrchestraBundle\Entity\Message'
        ));
    }

    public function getName()
    {
        return 'orchestra_orchestrabundle_messagetype';
    }
}
