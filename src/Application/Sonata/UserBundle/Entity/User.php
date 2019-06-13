<?php

namespace Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * This file has been generated by the SonataEasyExtendsBundle.
 *
 * @link https://sonata-project.org/easy-extends
 *
 * References:
 * @link http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 */
class User extends BaseUser
{
    /**
     * @var int $id
     */
    protected $id;

    protected $avatar;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\StudentsGroup", inversedBy="students")
     * @ORM\JoinTable(name="students_belongs_to_groups")
     */
    protected $studentsGroups;

    /**
     * @return mixed
     */
    public function getStudentsGroups()
    {
        return $this->studentsGroups;
    }

    /**
     * @param mixed $studentsGroups
     */
    public function setStudentsGroups($studentsGroups)
    {
        $this->studentsGroups = $studentsGroups;
    }

    /**
     * @var string $firebaseToken
     */
    protected $firebaseToken;

    public function __construct()
    {

        parent::__construct();
        $this->plainPassword = $this->generateRandomString(6);

    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Get id.
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirebaseToken()
    {
        return $this->firebaseToken;
    }

    /**
     * @param mixed $firebaseToken
     */
    public function setFirebaseToken($firebaseToken)
    {
        $this->firebaseToken = $firebaseToken;
    }

    public function setAvatar(\Application\Sonata\MediaBundle\Entity\Media $avatar)
    {
        $this->avatar = $avatar;
        return $this;

    }

    public function getAvatar()
    {
        return $this->avatar;

    }
}
