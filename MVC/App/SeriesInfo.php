<?php


namespace App;

use App\Core\Model;

class SeriesInfo extends Model
{
    protected $item_id;
    protected $title;
    protected $description;
    protected $image;
    protected $number_of_seasons;

    public function __construct($title = "", $description = "", $image = "", $numberOfSeasons = "")
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->number_of_seasons = $numberOfSeasons;
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
    public function setTitle($title): void
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
    public function setDescription($description): void
    {
        $this->description = $description;
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
     * @return mixed
     */
    public function getNumberOfSeasons()
    {
        return $this->number_of_seasons;
    }

    /**
     * @param mixed $numberOfSeasons
     */
    public function setNumberOfSeasons($numberOfSeasons): void
    {
        $this->number_of_seasons = $numberOfSeasons;

    }

    /**
     * @return mixed
     */
    public function getItem_Id()
    {
        return $this->item_id;
    }

    static public function setDbColumns()
    {
        return ['item_id', 'title', 'description', 'image', 'release_date', 'series_id', 'number_of_seasons'];
    }

    static public function setTableName()
    {
        return "item JOIN series USING (item_id)";
    }
}