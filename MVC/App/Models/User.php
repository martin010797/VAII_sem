<?php


namespace App\Models;


class User extends \App\Core\Model
{
    protected $user_id;
    protected $email;
    protected $password;
    protected $maintainer;

    public function __construct($user_id = "", $email = "", $password = "", $maintainer = "")
    {
        $this->user_id = $user_id;
        //$this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->maintainer = $maintainer;
    }

    static public function setDbColumns()
    {
        return ['user_id', 'email', 'password', 'maintainer'];
    }

    static public function setTableName()
    {
        return 'user';
    }

    /**
     * @return mixed
     */
    public function getMaintainer()
    {
        return $this->maintainer;
    }

    /**
     * @param mixed $maintainer
     */
    public function setMaintainer($maintainer): void
    {
        $this->maintainer = $maintainer;
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

    /**
     * @return mixed|string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed|string $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }
}