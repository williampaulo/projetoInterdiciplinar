<?php

  header('Content-type: application/json');

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['origemUrl']) {

    include 'encurtador.class.php';

    $origemUrl = $_POST['origemUrl'];

    try {

      $encurtador = new Encurtador();

      $res = $encurtador->encurtar($origemUrl);

      die($res);

      if (is_bool($res) && $res === false) {
        throw new Exception("url_error", 1);
      } else {
        echo $res;
      }

    } catch (\PDOException $e) {
      echo json_encode(['error' => $e->getMessage()]);
      return;
    }

  } else {
    echo json_encode(['error' => 'url_empty']);
  }
