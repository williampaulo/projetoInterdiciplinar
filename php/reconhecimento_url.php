<?php
  header('Location: ../index.php?error=url_empty');
  return;
  if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['q']) {

    $keyUrl = $_GET['q'];

    $servername = "158.69.73.106";
    $username = "root";
    $password = "123456";

    try {

      $conn = new PDO("mysql:host=$servername;dbname=shorturl", $username, $password);
      // definindo o PDO modo de exceção de erro
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // echo "Connected successfully";

      // checa se a url existe
      $sqlCheca = "
        SELECT id, value FROM url WHERE id = :keyUrl;
      ";

      $checked = $conn->prepare($sqlCheca);
      $checked->bindParam(':keyUrl', $keyUrl, PDO::PARAM_STR);

      if ($checked->execute()) {

        $row = $checked->fetch(PDO::FETCH_OBJ);

        if (!!$row && count($row) > 0) {

          $redirectUrl = $row->value;

          header('Location: ' . $redirectUrl);
          return;

        } else {

          //header('Location: ../index.php?error=url_not_found');
          return;

        }
      } else {
        throw new Exception("Error Processing Request", 1);
      }

    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

  } else {

    //header('Location: ../index.php?error=url_empty');

  }
