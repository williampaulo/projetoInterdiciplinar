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
    // Verificando se a classe Url já esta carregada
    if (!$this->url) {
      $this->url = new Url();
    }

    $protocol =
      strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
    $domain   = $_SERVER['HTTP_HOST'];
    $baseUrl  = $protocol . '://' . $domain . '/q/';
    // Define a o domínio do site do encurtador
    $this->baseUrl = $baseUrl;
  }

  public function encurtar($url)
  {
    // Retorna a url
    $resSelect = $this->url->retornaUrlPorUrl($url);

    // Se não retornar um boolean
    if (!is_bool($resSelect)) {
      // Retorna a url encurtada
      return $this->baseUrl . $resSelect;

    } else {

      // Insere a url original
      $resInsert = $this->url->insertUrl($url);

      // Se não retornar um boolean
      if (!is_bool($resInsert)) {
        // Retorna a url encurtada
        return $this->baseUrl . $resInsert;
      } else {
        // Retorna o boolean
        return false;
      }
    }
  }
}
