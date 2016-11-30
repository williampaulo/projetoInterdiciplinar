<?php

include 'url.class.php';

/**
*
*/
class ReconhecerUrl
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

  public function reconhecer($keyUrl)
  {

    $resSelect = $this->url->retornaUrlPorId($keyUrl);

    return $resSelect;
  }
}
