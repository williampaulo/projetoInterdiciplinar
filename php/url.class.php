<?php

// Incluindo a classe database
include 'database.class.php';


/**
* Url, responsável por fazer CRUD das url's
*/
class Url
{

  private $db;

  function __construct()
  {
    // Verifica se já foi definido o Database
    if (!$this->db) {
      $this->db = new Database();
    }
  }

  public function retornaUrlPorUrl($fullUrl)
  {
    // Definindo o select de busca de url por url
    $sql = "
      SELECT id, value FROM url WHERE value = :fullUrl;
    ";

    // Preparando a requisição
    $select = $this->db->prepare($sql);
    // Passando o parametro do sql
    $select->bindParam(':fullUrl', $fullUrl, \PDO::PARAM_STR);

    // Verifica se execulta o select
    if ($select->execute()) {

      // Retorna como objeto os dados do select
      $row = $select->fetch( \PDO::FETCH_OBJ );

      // Verifica se encontrou ao menos uma linha de dados
      if (!!$row && count($row) > 0) {
        // Retorna a url
        return $baseUrl . $row->id;

      } else {

        return false;
      }
    } else {

      return false;
    }
  }

  public function retornaUrlPorId($id)
  {
    // Definindo o select de busca de url por id
    $sql = "
      SELECT id, value FROM url WHERE id = :id;
    ";

    // Preparando a requisição
    $select = $this->db->prepare($sql);
    // Passando o parametro do sql
    $select->bindParam(':id', $id, \PDO::PARAM_STR);

    // Verifica se execulta o select
    if ($select->execute()) {

      // Retorna como objeto os dados do select
      $row = $select->fetch( \PDO::FETCH_OBJ );

      // Verifica se encontrou ao menos uma linha de dados
      if (!!$row && count($row) > 0) {
        // Retorna a url origem
        return $row->value;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function insertUrl($fullUrl)
  {
    // Definindo o insert da url
    $sql = "
      INSERT INTO url ( value ) VALUES ( :fullUrl );
    ";

    // Preparando a requisição
    $insert = $this->db->prepare($sql);
    // Passando o parametro para o sql
    $insert->bindParam(':fullUrl', $fullUrl, \PDO::PARAM_STR);

    // Verifica se execultou o insert
    if ($insert->execute()) {
      // Retorna o dado
      return $this->db->lastInsertId();

    } else {

      return false;
    };
  }
}
