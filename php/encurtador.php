<?php

  header('Content-type: application/json');

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['origemUrl']) {
  // if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['full_url']) {

    // 1 - pega a url
    // 2 - salva no banco de dados
    // 3 - gera uma url pelo serviço de encurtamento
    // 4 - retorna a url encurtada

    // $fullUrl = $_POST['full_url'];
    $fullUrl  = $_POST['origemUrl'];
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')
                === FALSE ? 'http' : 'https';
    $domain   = $_SERVER['HTTP_HOST'];
    $baseUrl  = $protocol . '://' . $domain . '/q/';

    $servername = "158.69.73.106";
    $username = "root";
    $password = "123456";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=shorturl", $username, $password);
      // definindo o PDO modo de exceção de erro
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // echo "Connected successfully";

      // $params = ['fullUrl' => $fullUrl];

      // checa se foi cadastrado, anteriormente, a url
      $sqlCheca = "
        SELECT id, value FROM url WHERE value = :fullUrl;
      ";

      $checked = $conn->prepare($sqlCheca);
      $checked->bindParam(':fullUrl', $fullUrl, PDO::PARAM_STR);

      if ($checked->execute()) {

        $row = $checked->fetch(PDO::FETCH_OBJ);

        if (!!$row && count($row) > 0) {

          // return;
          $shortUrl = [
            'shortUrl' => $baseUrl . $row->id
          ];

          echo json_encode($shortUrl);
          return;
        }
      }

      $sql = "
        INSERT INTO url ( value ) VALUES ( :fullUrl );
      ";

      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':fullUrl', $fullUrl, PDO::PARAM_STR);
      // $stmt->bindParam(':fullUrl', $fullUrl);



      if ($stmt->execute()) {

        $shortUrl = [
          'shortUrl' => $baseUrl . $conn->lastInsertId(),
          'eita' => 'sa'
        ];

        echo json_encode($shortUrl);
        return;
      };

    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

  } else {

    header('Location: ../index.php?error=url_empty');

  }
