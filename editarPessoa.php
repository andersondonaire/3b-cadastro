<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php
include "./conexao.php";

$id = intval($_REQUEST['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql = "UPDATE pessoas SET 
            nome = :nome,
            telefone = :telefone,
            email = :email
            WHERE id = :id";
    
    $params = [
        ':nome' => $_POST['nome'],
        ':telefone' => $_POST['telefone'],
        ':email' => $_POST['email'],
        ':id' => $id
    ];

    $resultadoDaEdicao = executarQuery($sql, $params);
    
    if ($resultadoDaEdicao != 0) {
        echo "Registro alterado: <a href=\"./\">Voltar</a>";
    } else {
        echo "Erro ao alterar registro!";
    }
}

// Corrige a seleção do registro
$sql = "SELECT * FROM pessoas WHERE id = :id";
$params = [':id' => $id];
$resultados = executarQuery($sql, $params, true);

?>

</head>

<body>

    <div class="container mt-5">
        <h2>Formulário de Edição</h2>
        <form action="./editarPessoa.php?id=<?= $id ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="nome" required value="<?= $resultados[0]['nome'] ?>">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telefone</label>
                <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Digite seu telefone" required value="<?= $resultados[0]['telefone'] ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required value="<?= $resultados[0]['email'] ?>">
            </div>

            <input type="hidden" name="acao" value="cadastrar">

            <button type="submit" class="btn btn-primary"> Salvar</button>
        </form>
    </div>
    <hr>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>