<?php

namespace Orchestra\OrchestraBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Orchestra\OrchestraBundle\Entity\Module;

class ModuleAdmin extends Admin {

    protected $baseRouteName = 'module_admin';
    protected $baseRoutePattern = 'module';

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
                ->add('intitule')
                ->add('description')
                ->add('date')
                ->add('moduleUser')
                ->add('user')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('intitule')
                ->add('description')
                ->add('date')
                ->add('moduleUser')
                ->add('user')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('intitule')
                ->add('moduleUser')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('intitule')
                ->add('description')
                ->add('date')
                ->add('moduleUser')
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
