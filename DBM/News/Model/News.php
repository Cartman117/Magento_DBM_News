<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 27/08/2017
 * Time: 12:18
 */

namespace DBM\News\Model;

class News
{
    private $id;
    private $title;
    private $date;
    private $like;
    private $url;

    public function __construct($id, $title, $date, $like, $url)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setDate($date);
        $this->setLike($like);
        $this->setUrl($url);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    private function setId($id)
    {
        $this->id = $id;
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
    private function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    private function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * @param mixed $like
     */
    private function setLike($like)
    {
        $this->like = $like;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    private function setUrl($url)
    {
        $this->url = $url;
    }
}