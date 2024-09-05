<?php

include "./conexao.php";

//retorna todos os dados da tabela pessoas
if ($_REQUEST['acao'] == "selectTabela") {

    $sql = "SELECT * FROM pessoas";
    $params = null;
    $resultados = executarQuery($sql, $params, true);
    // var_dump($resultados);
    if ($resultados) {
        echo json_encode(['success' => true, 'resposta' => $resultados], JSON_FORCE_OBJECT);
    } else {
        echo json_encode(['success' => false, 'resposta' => "erro na consulta"]);
    }
}

if ($_REQUEST['acao'] == "cadastrar") {

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    // Insere um novo registro na tabela 'pessoas'
    $sql = "INSERT INTO pessoas (nome, telefone, email) VALUES (:nome, :telefone, :email)";
    $params = [
        ':nome' => $nome,
        ':telefone' => $telefone,
        ':email' => $email
    ];

    $ultimoId = executarQuery($sql, $params);

    echo json_encode(['success' => true, 'mensagem' => "Novo ID inserido: " . $ultimoId], JSON_FORCE_OBJECT);
}

if ($_REQUEST['acao'] == "excluir") {
   //comando para excluir item do banco de dados
   //DELETE FROM pessoas WHER id=  
}
