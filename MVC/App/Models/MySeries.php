<?php


namespace App\Models;


use App\Core\Model;
use App\SeriesInfo;

class MySeries extends SeriesInfo
{
    protected $user_id;

    public function __construct($title = "", $description = "", $numberOfSeasons = "")
    {
        $this->title = $title;
        $this->description = $description;
        //$this->image = $image;
        $this->number_of_seasons = $numberOfSeasons;
        $this->type = "s";
    }

    static public function setDbColumns()
    {
        return ['item_id', 'title', 'description', 'image_name', 'series_id', 'number_of_seasons', 'user_item_id', 'user_id'];
    }

    static public function setTableName()
    {
        return "item JOIN series USING (item_id) JOIN user_items USING (item_id)";
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