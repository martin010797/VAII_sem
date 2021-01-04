<?php


namespace App\Models;


class User extends \App\Core\Model
{
    protected $id;
    protected $email;
    protected $password;

    public function __construct($id = "", $email = "", $password = "")
    {
        $this->id = $id;
        //$this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    static public function setDbColumns()
    {
        return ['user_id', 'email', 'password'];
    }

    static public function setTableName()
    {
        return 'user';
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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }
}