<?php

namespace ProjetoInterdiciplinar;

use ProjetoInterdiciplinar\Database;

include 'database.class.php';


/**
*
*/
class Url
{

  private $db;

  function __construct()
  {
    if (!$this->db) {
      $this->db = new Database();
    }
  }

  public function retornaUrl($fullUrl)
  {

    $sql = "
      SELECT id, value FROM url WHERE value = :fullUrl;
    ";

    $select = $this->db->prepare($sql);

    $select->bindParam(':fullUrl', $fullUrl, \PDO::PARAM_STR);

    if ($select->execute()) {

      $row = $select->fetch( \PDO::FETCH_OBJ );

      if (!!$row && count($row) > 0) {

        return $baseUrl . $row->id;

      } else {

        return false;
      }
    } else {

      return false;
    }

  }

  public function insertUrl($fullUrl)
  {

    $sql = "
      INSERT INTO url ( value ) VALUES ( :fullUrl );
    ";

    $insert = $this->db->prepare($sql);
    $insert->bindParam(':fullUrl', $fullUrl, \PDO::PARAM_STR);
    // $stmt->bindParam(':fullUrl', $fullUrl);

    if ($insert->execute()) {

      return $this->db->lastInsertId();

    } else {

      return false;
    };
  }
}
