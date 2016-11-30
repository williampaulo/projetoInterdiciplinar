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
    // Verificando se a classe Url já esta carregada
    if (!$this->url) {
      $this->url = new Url();
    }
  }

  public function recuperar($keyUrl)
  {
    // Consultando a url
    $resSelect = $this->url->retornaUrlPorId($keyUrl);
    // Retornando a url de origem ou boolean false
    return $resSelect;
  }
}
