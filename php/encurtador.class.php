<?php

// Incluindo a classe url
include 'url.class.php';

/**
* Encurtador, execulta o processo de encurtamento
*/
class Encurtador
{

  private $url;

  function __construct()
  {
    if (!$this->url) {
      $this->url = new Url();
    }

    $protocol =
      strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
    $domain   = $_SERVER['HTTP_HOST'];
    $baseUrl  = $protocol . '://' . $domain . '/q/';

    $this->baseUrl = $baseUrl;
  }

  public function encurtar($url)
  {

    $resSelect = $this->url->retornaUrlPorUrl($url);

    if (!is_bool($resSelect)) {

      return $this->baseUrl . $resSelect;

    } else {

      $resInsert = $this->url->insertUrl($url);

      if (!is_bool($resInsert)) {
        return $this->baseUrl . $resInsert;
      } else {
        return false;
      }
    }
  }
}
