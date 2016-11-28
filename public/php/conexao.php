<?php

  $servername = "158.69.73.106";
  $username = "root";
  $password = "123456";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=shorturl", $username, $password);
    // definindo o PDO modo de exceção de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully";

  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
