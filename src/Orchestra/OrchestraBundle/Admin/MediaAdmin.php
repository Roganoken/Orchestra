<?php

namespace Orchestra\OrchestraBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Orchestra\OrchestraBundle\Entity\Media;

class MediaAdmin extends Admin {

    protected $baseRouteName = 'media_admin';
    protected $baseRoutePattern = 'media';

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
            ->add('intitule')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('intitule')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('intitule')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('intitule')
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
