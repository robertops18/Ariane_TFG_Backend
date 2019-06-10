<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-06-10
 * Time: 22:38
 */

namespace ApiBundle\Controller\aux;


class Marker
{
    protected $key;
    protected $latlng;
    protected $title;
    protected $description;

    /**
     * Marker constructor.
     * @param $key
     * @param $latlng
     * @param $title
     * @param $description
     */
    public function __construct($key, $latlng, $title, $description)
    {
        $this->key = $key;
        $this->latlng = $latlng;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getLatlng()
    {
        return $this->latlng;
    }

    /**
     * @param mixed $latlng
     */
    public function setLatlng($latlng)
    {
        $this->latlng = $latlng;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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


}