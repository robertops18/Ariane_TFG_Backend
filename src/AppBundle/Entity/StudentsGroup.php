<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-03-19
 * Time: 16:11
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * School
 *
 * @ORM\Table(name="group_students")
 * @ORM\Entity()
 */
class StudentsGroup extends Base
{
    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $groupName;

    /**
     * @ORM\OneToMany(targetEntity="Application\Sonata\UserBundle\Entity\User", mappedBy="studentsGroup")
     */
    protected $students;

    public function __construct() {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * @param mixed $groupName
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    }

    public function __toString()
    {
        return (string) $this->getGroupName();
    }


}