<?php
include_once('connect.php');

class database
{
    public $dbh;
    private $host;
    private $dbname;
    private $user;
    private $pass;

    public function __construct($host=HOST, $dbname=DATABASE, $user=USER, $pass=PASSWORD)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;
    }

    private function connect(array $options=array())
    {
        $this->dbh = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass, $options);
        $this->dbh->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
        $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->dbh;
    }

    private function disconnect()
    {
        $this->dbh = null;
    }

    public function prepare($query, array $params)
    {
        try {
            $this->connect();
            $results = $this->dbh->prepare($query);
            $results->execute($params);
            if(stripos($query, "select") === 0)
                $results = $results->fetchAll();
            else
                $results = array("newid"=>$this->dbh->lastInsertId());
            $this->disconnect();
        } catch(PDOException $e){
            $results = array("error"=>$e->getMessage(),
                "code"=>$e->getCode(),
                "stacktrace"=>$e->getTrace());
        }
        return $results;
    }

    public function query($query)
    {
        try {
            $this->connect();
            $results = $this->dbh->query($query);
            $results = $results->fetchAll();
            $this->disconnect();
        } catch(PDOException $e){
            $results = array("error"=>$e->getMessage(),
                "code"=>$e->getCode(),
                "stacktrace"=>$e->getTrace());
        }
        return $results;
    }

}