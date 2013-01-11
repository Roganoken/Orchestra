<?php

namespace Orchestra\OrchestraBundle\Admin;
 
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
 
class UserAdmin extends Admin
{
  
  protected $baseRouteName = 'user';  
  protected $baseRoutePattern = 'user';
    
  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper
      ->add('firstname')
      ->add('lastname')
    ;
  }
 
  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    $datagridMapper
      ->add('firstname')
      ->add('lastname')
    ;
  }
 
  protected function configureListFields(ListMapper $listMapper)
  {
    $listMapper
      ->add('firstname')
      ->add('lastname')
    ;
  }
 
  public function validate(ErrorElement $errorElement, $object)
  {
    $errorElement
      ->add('firstname')
      ->assertMaxLength(array('limit' => 32))
      ->end()
    ;
  }
}