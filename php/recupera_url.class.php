<?php
// Incluindo a classe Url
include 'url.class.php';

/**
* RecuperaUrl, retorna a url de origem
*/
class RecuperaUrl
{

  private $url;

  function __construct()
  {
  }

  public function recuperar($keyUrl)
  {
    // Consultando a url
    $resSelect = $this->url->retornaUrlPorId($keyUrl);
    // Retornando a url de origem ou boolean false
    return $resSelect;
  }
}
