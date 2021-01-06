<?php


namespace App\Models;


use App\Core\Model;

class MyMovies extends Model
{
    protected $item_id;
    protected $title;
    protected $description;
    protected $image;
    protected $duration;
    protected $type;
    protected $user_id;

    public function __construct($title = "", $description = "", $image = "", $duration = "")
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->duration = $duration;
        $this->type = "m";
    }

    static public function setDbColumns()
    {
        return ['item_id', 'title', 'description', 'image', 'release_date', 'movie_id', 'duration', 'user_item_id', 'user_id'];
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

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * @param mixed $item_id
     */
    public function setItemId($item_id): void
    {
        $this->item_id = $item_id;
    }

    /**
     * @return mixed|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed|string $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed|string $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed|string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed|string $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed|string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed|string $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}