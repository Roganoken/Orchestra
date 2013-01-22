<?php

namespace Orchestra\OrchestraBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Orchestra\OrchestraBundle\Entity\Image;

class ImageAdmin extends Admin {

    protected $baseRouteName = 'image_admin';
    protected $baseRoutePattern = 'image';

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
            ->add('titre')
            ->add('descriptif')
            ->add('dateCreation')
            ->add('url')
            ->add('taille')
            ->add('poids')
            ->add('logiciel')
            ->add('created')
            ->add('updated')
            ->add('isPortfolio')
            ->add('user')
            ->add('media')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('titre')
            ->add('descriptif')
            ->add('dateCreation')
            ->add('url')
            ->add('taille')
            ->add('poids')
            ->add('logiciel')
            ->add('isPortfolio')
            ->add('user', 'entity', array(
                             'class' => 'OrchestraOrchestraBundle:User',
                             'property' => 'lastname'))
            ->add('media', 'entity', array(
                             'class' => 'OrchestraOrchestraBundle:Media',
                             'property' => 'intitule'))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('titre')
            ->add('media')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('titre')
            ->add('media')
            ->add('dateCreation')
            ->add('user')
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
