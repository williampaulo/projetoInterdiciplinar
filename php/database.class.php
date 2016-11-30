<?php

include 'configdb.class.php';

/**
*
*/
class Database extends \PDO
{

  private $driver, $host, $username, $password, $database;

  function __construct()
  {
    $this->driver   = Configdb::$DB_DRIVER;
    $this->host     = Configdb::$DB_SERVER;
    $this->username = Configdb::$DB_USERNAME;
    $this->password = Configdb::$DB_PASSWORD;
    $this->database = Configdb::$DB_NAME;

    // mysql:host=$servername;dbname=shorturl
    // construindo o dns
    $dns = "{$this->driver}:host={$this->host};dbname={$this->database}";

    parent::__construct($dns, $this->username, $this->password);

    try {
      $this->setAttribute( \PDO::ATTR_PERSISTENT, TRUE );
      $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
      die($e->getMessage());
    }

  }

}
