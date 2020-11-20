<?php

namespace App\Core;

use App\App;
use PDO;
use PDOException;

/**
 * Class Model
 * Abstract class serving as a simple model example, predecessor of all models
 * Allows basic CRUD operations
 * @package App\Core\Storage
 */
abstract class Model
{
    private static $db = null;
    private static $pkColumn = 'id';

    abstract static public function setDbColumns();

    abstract static public function setTableName();

    /**
     * Gets a db columns from a model
     * @return mixed
     */
    private static function getDbColumns()
    {
        return static::setDbColumns();
    }

    /**
     * Reads the table name from a model
     * @return mixed
     */
    private static function getTableName()
    {
        return static::setTableName();
    }

    /**
     * Creates a new connection to DB, if connection already exists, returns the existing one
     */
    private static function connect()
    {
        $config = App::getConfig();
        try {
            if (self::$db == null) {
                self::$db = new PDO('mysql:dbname=' . $config::DB_NAME . ';host=' . $config::DB_HOST, $config::DB_USER, $config::DB_PASS);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $e) {
            throw new \Exception('Connection failed: ' . $e->getMessage());
        }
    }

    /**
     * Gets DB connection for additional model methods
     * @return null
     */
    protected static function getConnection() : PDO
    {
        self::connect();
        return self::$db;
    }

    /**
     * Return an array of models from DB
     * @return static[]
     */
    static public function getAll()
    {
        self::connect();
        try {
            $stmt = self::$db->query("SELECT * FROM " . self::getTableName());
            $dbModels = $stmt->fetchAll();
            $models = [];
            foreach ($dbModels as $model) {
                $tmpModel = new static();
                $data = array_fill_keys(self::getDbColumns(), null);
                foreach ($data as $key => $item) {
                    $tmpModel->$key = $model[$key];
                }
                $models[] = $tmpModel;
            }
            return $models;
        } catch (PDOException $e) {
            throw new \Exception('Query failed: ' . $e->getMessage());
        }
    }
    static public function getRecentlyAddedItems(){
        self::connect();
        try {
            //$stmt = self::$db->query("SELECT * FROM " . self::getTableName());
            $stmt = self::$db->query("SELECT * FROM (
    SELECT * FROM " . self::getTableName() . " ORDER BY item_id DESC LIMIT 5
) sub
ORDER BY item_id DESC");
            $dbModels = $stmt->fetchAll();
            $models = [];
            foreach ($dbModels as $model) {
                $tmpModel = new static();
                $data = array_fill_keys(self::getDbColumns(), null);
                foreach ($data as $key => $item) {
                    $tmpModel->$key = $model[$key];
                }
                $models[] = $tmpModel;
            }
            return $models;
        } catch (PDOException $e) {
            throw new \Exception('Query failed: ' . $e->getMessage());
        }
    }

    //function changed by adding parameter for id column name
    /**
     * Gets one model by primary key
     * @param $id
     * @throws \Exception
     */
    static public function getOne($id , $columnName)
    {
        self::connect();
        try {
            $sql = "SELECT * FROM " . self::getTableName() . " WHERE $columnName=$id";
            //$sql = "SELECT * FROM " . self::getTableName() . " WHERE id=$id";
            $stmt = self::$db->prepare($sql);
            $stmt->execute([$id]);
            $model = $stmt->fetch();
            if ($model) {
                $data = array_fill_keys(self::getDbColumns(), null);
                $tmpModel = new static();
                foreach ($data as $key => $item) {
                    $tmpModel->$key = $model[$key];
                }
                return $tmpModel;
            } else {
                throw new \Exception('Record not found!');
            }
        } catch (PDOException $e) {
            throw new \Exception('Query failed: ' . $e->getMessage());
        }
    }

    /**
     * Saves the current model to DB (if model id is set, updates it, else creates a new model)
     * @return mixed
     */
    public function save()
    {
        self::connect();
        try {
            $data = array_fill_keys(self::getDbColumns(), null);
            foreach ($data as $key => &$item) {
                $item = $this->$key;
            }
            if ($data[self::$pkColumn] == null) {
                $arrColumns = array_map(fn($item) => (':' . $item), array_keys($data));
                $columns = implode(',', array_keys($data));
                $params = implode(',', $arrColumns);
                $sql = "INSERT INTO " . self::getTableName() . " ($columns) VALUES ($params)";
                self::$db->prepare($sql)->execute($data);
                return self::$db->lastInsertId();
            } else {
                $arrColumns = array_map(fn($item) => ($item . '=:' . $item), array_keys($data));
                $columns = implode(',', $arrColumns);
                $sql = "UPDATE " . self::getTableName() . " SET $columns WHERE id=:" . self::$pkColumn;
                self::$db->prepare($sql)->execute($data);
                return $data[self::$pkColumn];
            }
        } catch (PDOException $e) {
            throw new \Exception('Query failed: ' . $e->getMessage());
        }
    }

    public function saveMovie(){
        self::connect();
        try {
            $sql = 'INSERT INTO item(title, description, image) VALUES (?, ?, ?)';
            self::$db->prepare($sql)->execute([$this->title, $this->description, $this->image]);
            $id = self::$db->query('SELECT MAX(item_id) FROM item');
            $idValue = -1;
            foreach ($id as $idVal) {
                $idValue = $idVal['MAX(item_id)'];
            }
            $sql = 'INSERT INTO movie(duration, item_id) VALUES (?, ?)';
            self::$db->prepare($sql)->execute([$this->duration, $idValue]);

        } catch (PDOException $e) {
            echo "Nepodarilo sa zapisat do DB:" . $e->getMessage();
        }
    }

    public function editMovie(){
        self::connect();
        try {
            $sql = 'UPDATE item SET title=?, description=?, image=? WHERE item_id=?';
            self::$db->prepare($sql)->execute([$this->title, $this->description, $this->image, $this->item_id]);
            $sql = 'UPDATE movie SET duration=? WHERE item_id=?';
            self::$db->prepare($sql)->execute([$this->duration, $this->item_id]);

        } catch (PDOException $e) {
            echo "Nepodarilo sa zapisat do DB:" . $e->getMessage();
        }
    }

    public function editSeries(){
        self::connect();
        try {
            $sql = 'UPDATE item SET title=?, description=?, image=? WHERE item_id=?';
            self::$db->prepare($sql)->execute([$this->title, $this->description, $this->image, $this->item_id]);
            $sql = 'UPDATE series SET number_of_seasons=? WHERE item_id=?';
            self::$db->prepare($sql)->execute([$this->number_of_seasons, $this->item_id]);

        } catch (PDOException $e) {
            echo "Nepodarilo sa zapisat do DB:" . $e->getMessage();
        }
    }

    public function saveSeries(){
        self::connect();
        try {
            $sql = 'INSERT INTO item(title, description, image) VALUES (?, ?, ?)';
            self::$db->prepare($sql)->execute([$this->title, $this->description, $this->image]);
            $id = self::$db->query('SELECT MAX(item_id) FROM item');
            $idValue = -1;
            foreach ($id as $idVal) {
                $idValue = $idVal['MAX(item_id)'];
            }
            $sql = 'INSERT INTO series(number_of_seasons, item_id) VALUES (?, ?)';
            self::$db->prepare($sql)->execute([$this->number_of_seasons, $idValue]);

        } catch (PDOException $e) {
            echo "Nepodarilo sa zapisat do DB:" . $e->getMessage();
        }
    }

    /**
     * Deletes current model from DB
     * @throws \Exception If model not exists, throw an exception
     */
    public function delete()
    {
        if ($this->{self::$pkColumn} == null) {
            return;
        }
        self::connect();
        try {
            $sql = "DELETE FROM " . self::getTableName() . " WHERE id=?";
            $stmt = self::$db->prepare($sql);
            $stmt->execute([$this->{self::$pkColumn}]);
            if ($stmt->rowCount() == 0) {
                throw new \Exception('Model not found!');
            }
        } catch (PDOException $e) {
            throw new \Exception('Query failed: ' . $e->getMessage());
        }
    }

    static public function deleteMovie($id){
        self::connect();
        try {
            $sql = "DELETE FROM " . movie . " WHERE item_id=?";
            self::$db->prepare($sql)->execute([$id]);
            $sql = "DELETE FROM " . item . " WHERE item_id=?";
            self::$db->prepare($sql)->execute([$id]);
        } catch (PDOException $e) {
            throw new \Exception('Query failed: ' . $e->getMessage());
        }
    }

    static public function deleteSeries($id){
        self::connect();
        try {
            $sql = "DELETE FROM " . series . " WHERE item_id=?";
            self::$db->prepare($sql)->execute([$id]);
            $sql = "DELETE FROM " . item . " WHERE item_id=?";
            self::$db->prepare($sql)->execute([$id]);
        } catch (PDOException $e) {
            throw new \Exception('Query failed: ' . $e->getMessage());
        }
    }
}