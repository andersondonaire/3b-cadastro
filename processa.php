<?php

include "./conexao.php";
// var_dump($_REQUEST);

// Verifica a ação recebida via POST em JSON
$requestPayload = file_get_contents('php://input');
$data = json_decode($requestPayload, true); // Decodifica o JSON para um array PHP

header("Content-type: application/json; charset=utf-8");

//retorna todos os dados da tabela pessoas
if ($data['acao'] == "selectTabela") {

    $sql = "SELECT * FROM pessoas";
    $params = null;
    $resultados = executarQuery($sql, $params, true);

    if ($resultados) {
        echo json_encode(['success' => true, 'resposta' => $resultados]);
    } else {
        echo json_encode(['success' => false, 'resposta' => "erro na consulta"]);
    }
}

if ($data['acao'] == "cadastrar") {

    $nome = $data['nome'];
    $telefone = $data['telefone'];
    $email = $data['email'];

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

if ($data['acao'] == "excluir") {
    //comando para excluir item do banco de dados
    //DELETE FROM pessoas WHER id=  

    $id = $data['id'];

    $q = "DELETE FROM pessoas WHERE id = :id";
    $params = [
        ':id' => $id
    ];

    executarQuery($q, $params);

    echo json_encode(['success' => true, 'mensagem' => "O registro de número {$id} foi excluído"], JSON_FORCE_OBJECT);
}

if ($data['acao'] == "selectEdita") {

    $id = $data['id'];

    $query =  "SELECT * FROM pessoas WHERE id = :id";

    $params = [
        ':id' => $id
    ];

    $r = executarQuery($query, $params, true);

    echo json_encode(['success' => true, 'result' => $r], JSON_FORCE_OBJECT);
}

if ($data['acao'] == "editar") {

    $nome = $data['nome'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    $id = $data['id'];

    // Editar um registro na tabela 'pessoas'
    $sql = "UPDATE `pessoas` SET `nome`='{$nome}',`telefone`='{$telefone}',`email`='{$email}' WHERE id={$id}";

    $r = executarQuery($sql, $params);

    echo json_encode(['success' => true, 'retorno' => ($r > 0)? $r : "0"], JSON_FORCE_OBJECT);
}
