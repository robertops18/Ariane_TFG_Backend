<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-04-14
 * Time: 11:48
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class AnswerAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollection $collection) {
        //$collection->remove('show');
        //$collection->remove('create');
        //$collection->remove('export');
    }

    public function getExportFormats() {
        return ['xls'];
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('id')
            ->add('student')
            ->add('task')
            ->add('answer')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('id')
            ->add('student')
            ->add('task')
            ->add('answer')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('student')
            ->add('task')
            ->add('answer')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('id')
            ->add('student')
            ->add('task')
            ->add('answer')
        ;
    }
}