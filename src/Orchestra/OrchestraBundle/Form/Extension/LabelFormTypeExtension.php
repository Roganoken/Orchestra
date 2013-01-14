<?php

namespace Orchestra\OrchestraBundle\Form\Extension;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

class LabelFormTypeExtension extends AbstractTypeExtension {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        if (array_key_exists('label', $options) && $options['label'] === false) {
            $builder->setAttribute('label', false);
        }
    }

    public function getExtendedType() {
        return 'field';
    }
}
