<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-03-19
 * Time: 17:25
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class FieldAdmin extends AbstractAdmin
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
            ->add('demo')
            ->add('fieldTitle')
            ->add('initDate', 'doctrine_orm_date_range',
                array('label' => 'Init Date',
                    'field_type' => 'sonata_type_date_range_picker',
                    'advanced_filter' => false), 'sonata_type_date_range_picker',
                array('field_options_start' => array('format' => 'dd/MM/yyyy'), 'field_options_end' => array('format' => 'dd/MM/yyyy')))
            ->add('finishDate', 'doctrine_orm_date_range',
                array('label' => 'Finish Date',
                    'field_type' => 'sonata_type_date_range_picker',
                    'advanced_filter' => false), 'sonata_type_date_range_picker',
                array('field_options_start' => array('format' => 'dd/MM/yyyy'), 'field_options_end' => array('format' => 'dd/MM/yyyy')))
            ->add('area')
            ->add('studentsGroup')
            ->add('teacher')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('id')
            ->add('demo', null, ['editable' => true])
            ->add('fieldTitle')
            ->add('initDate')
            ->add('finishDate')
            ->add('area')
            ->add('studentsGroup')
            ->add('teacher')
            ->add('tasks')
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
            ->add('fieldTitle')
            ->add('demo')
            ->add('initDate')
            ->add('finishDate')
            ->add('area', null, array('label' => 'Area (City, Country)'))
            ->add('studentsGroup')
            ->add('teacher')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('id')
            ->add('fieldTitle')
            ->add('demo')
            ->add('initDate')
            ->add('finishDate')
            ->add('area')
            ->add('studentsGroup')
            ->add('teacher')
            ->add('tasks')
        ;
    }
}