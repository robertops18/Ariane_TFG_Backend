<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-03-19
 * Time: 17:17
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FieldActivity
 *
 * @ORM\Table(name="field_activities")
 * @ORM\Entity()
 */
class FieldActivity extends Base
{
    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $fieldTitle;

    /**
     * @ORM\Column(name="init_date", type="datetime")
     */
    protected $initDate;

    /**
     * @ORM\Column(name="finish_date", type="datetime")
     */
    protected $finishDate;

    /**
     * @ORM\Column(name="area", type="string")
     */
    protected $area;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\School")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     */
    protected $school;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id")
     */
    protected $teacher;

    /**
     * Many Fields activties have Many Students.
     * @ORM\ManyToMany(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinTable(name="fields_students",
     *      joinColumns={@ORM\JoinColumn(name="field_activity_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="student_id", referencedColumnName="id")}
     *      )
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Task", mappedBy="fieldActivity")
     */
    protected $tasks;

    public function __construct() {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param mixed $tasks
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param mixed $area
     */
    public function setArea($area)
    {
        $this->area = $area;
    }

    /**
     * @return mixed
     */
    public function getInitDate()
    {
        return $this->initDate;
    }

    /**
     * @param mixed $initDate
     */
    public function setInitDate($initDate)
    {
        $this->initDate = $initDate;
    }

    /**
     * @return mixed
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * @param mixed $finishDate
     */
    public function setFinishDate($finishDate)
    {
        $this->finishDate = $finishDate;
    }

    /**
     * @return mixed
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param mixed $teacher
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * @return mixed
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param mixed $students
     */
    public function setStudents($students)
    {
        $this->students = $students;
    }

    /**
     * @return mixed
     */
    public function getFieldTitle()
    {
        return $this->fieldTitle;
    }

    /**
     * @param mixed $fieldTitle
     */
    public function setFieldTitle($fieldTitle)
    {
        $this->fieldTitle = $fieldTitle;
    }

    /**
     * @return mixed
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @param mixed $school
     */
    public function setSchool($school)
    {
        $this->school = $school;
    }


}