<?php

namespace home\william\Code\UNP\ProjetoInterdiciplinar\php;

use ProjetoInterdiciplinar\ReconhecimentoUrl;


  header('Content-type: application/json');

  if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['q']) {

    include 'reconhecimento_url.class.php';

    $url = $_GET['q'];

    $reconhecimentoUrl = new ReconhecimentoUrl();

    $resUrl = $reconhecimentoUrl->reconhecer($url);

    if (!is_bool($resUrl)) {

      header('Location: ' . $resUrl);
      return;

    } else {

      header('Location: url-not-found');
      return;
    }

  } else {

    header('Location: ../');
  }
