<?php

namespace ProjetoInterdiciplinar;

use ProjetoInterdiciplinar\Url;

include 'url.class.php';

/**
*
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

    $resSelect = $this->url->retornaUrl($url);

    if (!is_bool($resSelect)) {

      $shortUrl = [
        'shortUrl' => $this->baseUrl . $resSelect,
      ];

      return json_encode($shortUrl);

    } else {

      $resInsert = $this->url->insertUrl($url);

      if (!is_bool($resInsert)) {


        $shortUrl = [
          'shortUrl' => $this->baseUrl . $resInsert,
          'eita' => 'sa'
        ];

        return json_encode($shortUrl);

      } else {

        echo json_encode(['error' => 'url_error_create']);

      }

    }
  }
}
