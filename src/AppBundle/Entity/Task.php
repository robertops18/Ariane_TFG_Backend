<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-04-14
 * Time: 11:08
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oh\GoogleMapFormTypeBundle\Traits\LocationTrait;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity()
 */
class Task extends Base
{
    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $taskName;

    /**
     * @ORM\Column(name="type", type="string")
     */
    protected $type;

    /**
     * @ORM\Column(name="question", type="string")
     */
    protected $question;

    /**
     * @ORM\Column(name="description", type="string")
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FieldActivity", inversedBy="tasks")
     * @ORM\JoinColumn(name="field_activity_id", referencedColumnName="id")
     */
    protected $fieldActivity;

    /**
     * @ORM\Column(name="num_answers", type="integer")
     */
    protected $numberOfAnswers;

    use LocationTrait;

    /**
     * @ORM\Column(name="options", type="string", nullable=true)
     */
    protected $options;

    /**
     * @ORM\Column(name="correct_answer", type="string", nullable=true)
     */
    protected $correctAnswer;

    /**
     * @ORM\Column(name="image_url", type="string", nullable=true)
     */
    protected $imageUrl;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Answer", mappedBy="task")
     */
    protected $answers;

    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->numberOfAnswers = sizeof($this->answers);
    }

    /**
     * @return mixed
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param mixed $answers
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }

    /**
     * @param mixed $correctAnswer
     */
    public function setCorrectAnswer($correctAnswer)
    {
        $this->correctAnswer = $correctAnswer;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getNumberOfAnswers()
    {
        return sizeof($this->answers);
    }

    /**
     * @param mixed $numberOfAnswers
     */
    public function setNumberOfAnswers($numberOfAnswers)
    {
        $this->numberOfAnswers = sizeof($this->answers);
    }

    /**
     * @return mixed
     */
    public function getTaskName()
    {
        return $this->taskName;
    }

    /**
     * @param mixed $taskName
     */
    public function setTaskName($taskName)
    {
        $this->taskName = $taskName;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

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

    public function __toString()
    {
        return (string) $this->getTaskName();
    }
}