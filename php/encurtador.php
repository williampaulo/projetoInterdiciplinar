<?php
  // Define o header de retorno como json
  header('Content-type: application/json');

  // Verifica se a requisição é de método POST e contém a propriedade "origemUrl"
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['origemUrl']) {

    // Inclue o classe encurtador, responsável pelos métodos de encurtamento
    include 'encurtador.class.php';

    // Adicionando o valor da propriedade do post na variável
    $origemUrl = $_POST['origemUrl'];

    // Envocando a class
    $encurtador = new Encurtador();

    // Chamando o metodo responsável por encurtar
    $res = $encurtador->encurtar($origemUrl);

    // Verifica se retornou um boolean
    if (!is_bool($res)) {
      // Retorna a nova url
      return json_encode(['short_url' => $this->baseUrl . $resSelect]);
    } else {
      // Retorna um erro
      return json_encode(['error' => 'url_error_create']);
    }
  } else {
    // Retorna um error
    return json_encode(['error' => 'url_empty']);
  }
