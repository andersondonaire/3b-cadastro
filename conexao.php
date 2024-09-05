<?php
function executarQuery($sql, $params = [], $retornaResultados = false)
{
    $host = 'localhost';
    $dbname = 'cadastro2';
    $username = 'root';
    $password = '';

    try {
        // Cria uma nova instância de PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

        // Define o modo de erro do PDO para exceções
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a declaração SQL
        $stmt = $pdo->prepare($sql);

        // Executa a consulta com os parâmetros
        $stmt->execute($params);

        // Retorna resultados, se necessário
        if ($retornaResultados) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Se for um comando INSERT, retorna o ID do último registro inserido
        if (stripos($sql, 'INSERT') === 0) {
            return $pdo->lastInsertId();
        }

        // Retorna o número de linhas afetadas para UPDATE e DELETE
        return $stmt->rowCount();
    } catch (PDOException $e) {
        // Em caso de erro, exibe a mensagem
        echo "Erro: " . $e->getMessage();
        return false;
    }
}
