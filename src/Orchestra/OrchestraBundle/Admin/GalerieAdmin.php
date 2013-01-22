<?php

namespace Orchestra\OrchestraBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Orchestra\OrchestraBundle\Entity\Galerie;

class GalerieAdmin extends Admin {

    protected $baseRouteName = 'galerie_admin';
    protected $baseRoutePattern = 'galerie';

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
            ->add('id')
            ->add('parentId')
            ->add('media')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('parentId')
            ->add('media', 'entity', array(
                             'class' => 'OrchestraOrchestraBundle:Media',
                             'property' => 'intitule'))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('media')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('id')
            ->add('parentId')
            ->add('media')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'view' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
        ;
        ;
    }

}
