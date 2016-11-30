<?php

  header('Content-type: application/json');

  if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['q']) {

    include 'reconhecer_url.class.php';

    $keyUrl = $_GET['q'];

    $reconhecimentoUrl = new ReconhecerUrl();

    $resUrl = $reconhecimentoUrl->reconhecer($keyUrl);

    if (!is_bool($resUrl)) {
      header('Location: ' . $resUrl);
      return;
    }

    header('Location: ../url-not-fould');
    return;

  } else {

    header('Location: ../');
  }
