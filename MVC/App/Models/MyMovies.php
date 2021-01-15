<?php


namespace App\Models;


use App\Core\Model;
use App\MovieInfo;

class MyMovies extends MovieInfo
{
    protected $user_id;

    public function __construct($title = "", $description = "", $duration = "")
    {
        $this->title = $title;
        $this->description = $description;
        //$this->image = $image;
        $this->duration = $duration;
        $this->type = "m";
    }

    static public function setDbColumns()
    {
        return ['item_id', 'title', 'description', 'image_name', 'movie_id', 'duration', 'user_item_id', 'user_id'];
    }

    static public function setTableName()
    {
        return "item JOIN movie USING (item_id) JOIN user_items USING (item_id)";
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }
}