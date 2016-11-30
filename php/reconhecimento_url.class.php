<?php

namespace ProjetoInterdiciplinar;

use ProjetoInterdiciplinar\Url;

include 'url.class.php';

/**
*
*/
class ReconhecimentoUrl
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

  public function reconhecer($url)
  {

    $resSelect = $this->url->retornaUrl($url);

    if (!is_bool($resSelect)) {

      $shortUrl = [
        'shortUrl' => $this->baseUrl . $resSelect,
      ];

      return json_encode($shortUrl);

    } else {

      return json_encode(['error' => 'url_not_found']);

    }
  }
}
