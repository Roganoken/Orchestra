<?php

namespace Orchestra\OrchestraBundle\Admin;
 
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
 
class SexAdmin extends Admin
{
  
  protected $baseRouteName = 'sex_admin';  
  protected $baseRoutePattern = 'sex';
    
  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper
      ->add('gender')
      ->add('title')
      ->add('titleAbbrev')
    ;
  }
 
  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    $datagridMapper
      ->add('gender')
    ;
  }
 
  protected function configureListFields(ListMapper $listMapper)
  {
    $listMapper
      ->add('gender')
      ->add('title')
      ->add('titleAbbrev')
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
 
  public function validate(ErrorElement $errorElement, $object)
  {
    $errorElement
      ->add('gender')
      ->assertMaxLength(array('limit' => 32))
      ->end()
    ;
  }
}