<?php


namespace App;

use App\Core\Model;

class SeriesInfo extends Model
{
    protected $item_id;
    protected $title;
    protected $description;
    protected $image;
    protected $image_name;
    protected $number_of_seasons;
    protected $type;

    /**
     * @param mixed $item_id
     */
    public function setItemId($item_id): void
    {
        $this->item_id = $item_id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function __construct($title = "", $description = "", $numberOfSeasons = "", $image_name = "")
    {
        $this->title = $title;
        $this->description = $description;
        //$this->image = $image;
        $this->number_of_seasons = $numberOfSeasons;
        $this->type = "s";
        $this->image_name = $image_name;
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

    /**
     * @return mixed|string
     */
    public function getImageName()
    {
        return $this->image_name;
    }

    /**
     * @param mixed|string $image_name
     */
    public function setImageName($image_name): void
    {
        $this->image_name = $image_name;
    }

    static public function setDbColumns()
    {
        return ['item_id', 'title', 'description', 'image_name', 'series_id', 'number_of_seasons'];
    }

    static public function setTableName()
    {
        return "item JOIN series USING (item_id)";
    }
}