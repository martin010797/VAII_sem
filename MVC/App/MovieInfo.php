<?php

namespace App;

use App\Core\Model;

class MovieInfo extends Model
{
    protected $item_id;
    protected $title;
    protected $description;
    protected $image;
    protected $image_name;
    protected $duration;
    protected $type;

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    public function __construct($title = "", $description = "", $duration = "", $image_name = "")
    {
        $this->title = $title;
        $this->description = $description;
        //$this->image = $image;
        $this->duration = $duration;
        $this->type = "m";
        $this->image_name = $image_name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->item_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($item_id): void
    {
        $this->item_id = $item_id;
    }

    /**
     * @return mixed
     */
    public function getImageName()
    {
        return $this->image_name;
    }

    /**
     * @param mixed $image_name
     */
    public function setImageName($image_name): void
    {
        $this->image_name = $image_name;
    }


    static public function setDbColumns()
    {
        //return ['id', 'title', 'description', 'image'];
        return ['item_id', 'title', 'description', 'image_name', 'movie_id', 'duration'];
    }

    static public function setTableName()
    {
        //return "movie_test";
        return "item JOIN movie USING (item_id)";
    }


}