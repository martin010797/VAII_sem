<?php


class DBStorage
{
    private const DB_HOST = "localhost";
    private const DB_NAME = "wtw";
    private const DB_USER = "root";
    private const DB_PASS = "dtb456";

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:dbname=" . self::DB_NAME . ';host=' . self::DB_HOST, self::DB_USER, self::DB_PASS);
        }catch (PDOException $e){
            echo "Spojenie neuspesne" . $e->getMessage();
        }
    }

    function loadAllMovies()
    {
        $movies = [];
        $dbMovies = $this->db->query('SELECT * FROM movie_test');
        foreach ($dbMovies as $movie) {
            //if (is_null($movie['image']))
            $movies[] = new MovieInfo($movie['title'], $movie['description'], $movie['image']);
        }
        return $movies;
    }

    function loadRecentlyAdded(){
        $movies = [];
        $dbMovies = $this->db->query('SELECT * FROM (
    SELECT * FROM movie_test ORDER BY id DESC LIMIT 5
) sub
ORDER BY id DESC');
        foreach ($dbMovies as $movie) {
            $movies[] = new MovieInfo($movie['title'], $movie['description'], $movie['image']);
        }
        return $movies;
    }

    function save(MovieInfo $movieInfo)
    {
        try{
            $sql = 'INSERT INTO movie(title, description, image) VALUES (?, ?, ?)';
            $this->db->prepare($sql)->execute([$movieInfo->getTitle(), $movieInfo->getDescription(), $movieInfo->getImage()]);
        }catch (PDOException $e){
            echo "Nepodarilo sa zapisat do DB:" . $e->getMessage();
        }
    }

}