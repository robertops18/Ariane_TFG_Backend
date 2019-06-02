<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-06-02
 * Time: 20:55
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oh\GoogleMapFormTypeBundle\Traits\LocationTrait;

/**
 * Log
 *
 * @ORM\Table(name="log")
 * @ORM\Entity()
 */
class Log extends Base
{
    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    protected $student;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Task")
     * @ORM\JoinColumn(name="task_id", referencedColumnName="id")
     */
    protected $task;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FieldActivity")
     * @ORM\JoinColumn(name="field_activity_id", referencedColumnName="id")
     */
    protected $fieldActivity;

    /**
     * @ORM\Column(name="action", type="string")
     */
    protected $action;

    use LocationTrait;

    /**
     * @return mixed
     */
    public function getFieldActivity()
    {
        return $this->fieldActivity;
    }

    /**
     * @param mixed $fieldActivity
     */
    public function setFieldActivity($fieldActivity)
    {
        $this->fieldActivity = $fieldActivity;
    }

    /**
     * @return mixed
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param mixed $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
    }

    /**
     * @return mixed
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @param mixed $task
     */
    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

}