<?php

include "./conexao.php";
header("Content-type: application/json; charset=utf-8");

//retorna todos os dados da tabela pessoas
if ($_REQUEST['acao'] == "selectTabela") {

    $sql = "SELECT * FROM pessoas";
    $params = null;
    $resultados = executarQuery($sql, $params, true);
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

    $id = $_POST['id'];

    $q = "DELETE FROM pessoas WHERE id = :id";
    $params = [
        ':id' => $id
    ];

    executarQuery($q, $params);

    echo json_encode(['success' => true, 'mensagem' => "O registro de número {$id} foi excluído"], JSON_FORCE_OBJECT);
}

if ($_REQUEST['acao'] == "selectEdita") {

    $id = $_POST['id'];

    $query =  "SELECT * FROM pessoas WHERE id = :id";

    $params = [
        ':id' => $id
    ];

    $r = executarQuery($query, $params, true);

    echo json_encode(['success' => true, 'result' => $r], JSON_FORCE_OBJECT);
}

if ($_REQUEST['acao'] == "editar") {

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $id = $_POST['id'];

    // Editar um registro na tabela 'pessoas'
    $sql = "UPDATE `pessoas` SET `nome`='{$nome}',`telefone`='{$telefone}',`email`='{$email}' WHERE id={$id}";

    $r = executarQuery($sql, $params);



    echo json_encode(['success' => true, 'retorno' => ($r > 0)? $r : "0"], JSON_FORCE_OBJECT);
}
