<?php

// Incluindo a classe config
include 'config_db.class.php';
/**
 * Database classe que faz a conexão com o banco de dados.
 */
class Database extends \PDO
{

  private $driver, $host, $username, $password, $database;

  function __construct()
  {
    $this->driver   = ConfigDb::$DB_DRIVER;
    $this->host     = ConfigDb::$DB_SERVER;
    $this->username = ConfigDb::$DB_USERNAME;
    $this->password = ConfigDb::$DB_PASSWORD;
    $this->database = ConfigDb::$DB_NAME;

    $dns = "{$this->driver}:host={$this->host};dbname={$this->database}";

    parent::__construct($dns, $this->username, $this->password);

    try {
      // Atribuindo persistencia e Exceptions de error
      $this->setAttribute( \PDO::ATTR_PERSISTENT, TRUE );
      $this->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
      // Caso algum erro de configuração acotença
      die($e->getMessage());
    }

  }

}
