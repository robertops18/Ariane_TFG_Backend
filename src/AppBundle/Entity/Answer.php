<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-04-14
 * Time: 11:46
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Table(name="answer")
 * @ORM\Entity()
 */
class Answer extends Base
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FieldActivity", inversedBy="answers")
     * @ORM\JoinColumn(name="field_activity_id", referencedColumnName="id")
     */
    protected $fieldActivity;

    /**
     * @ORM\Column(name="answer", type="string")
     */
    protected $answer;

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
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param mixed $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }


}