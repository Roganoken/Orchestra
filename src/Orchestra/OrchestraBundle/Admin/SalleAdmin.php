<?php

namespace Orchestra\OrchestraBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Orchestra\OrchestraBundle\Entity\Salle;

class SalleAdmin extends Admin {

    protected $baseRouteName = 'salle_admin';
    protected $baseRoutePattern = 'salle';

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
                ->add('numero')
                ->add('nom')
                ->add('capacite')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('numero')
                ->add('nom')
                ->add('capacite')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('numero')
                ->add('nom')
                ->add('capacite')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('numero')
                ->add('nom')
                ->add('capacite')
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
