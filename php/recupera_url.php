<?php
  // Define o header de retorno como json
  header('Content-type: application/json');

  // Verifica se a requisição é de método POST e contém a propriedade "q"
  if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['q']) {

    // Inclue o classe reconhecer_url, responsável pelos métodos de reconhecimento
    // de URL
    include 'recupera_url.class.php';

    // Adicionando o valor da propriedade do post na variável
    $keyUrl = $_GET['q'];

    // Envocando a class
    $recuperaUrl = new RecuperaUrl();

    // Chamando o metodo responsável por reconhecer a url
    $resUrl = $recuperaUrl->recuperar($keyUrl);

    // Verifica se retornou um boolean
    if (!is_bool($resUrl)) {
      // Redireciona
      header('Location: ' . $resUrl);
      return;
    }

    // Redireciona
    header('Location: ../url-not-fould');
    return;

  } else {

    // Redireciona
    header('Location: ../');
  }
