<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar Turmas</title>
    <link rel="icon" href="./assets/award.svg" type="image/png">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/adm.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<?php
include('../conexao.php');
$tabela = "dados";
$pasta = "../csv/alunos_com_dados/";

// Criar conexão
$conn = $conexao;

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Função para esvaziar a tabela
function esvaziarTabela($conexao, $tabela)
{
    $query = "DELETE FROM $tabela";
    if (mysqli_query($conexao, $query)) {
        echo "<span class='text-secondary'> Tabela $tabela esvaziada com sucesso!</span><br><br>";
        return true;
    } else {
        echo "Erro ao esvaziar tabela $tabela: " . mysqli_error($conexao) . "<br>";
        return false;
    }
}

// Função para importar os dados do arquivo CSV para o banco de dados
function importarDados($conn, $tabela, $caminho_arquivo) {
    $handle = fopen($caminho_arquivo, "r");
    if ($handle !== FALSE) {
        // Ler a primeira linha do arquivo CSV para obter os nomes das colunas
        $header = fgetcsv($handle, 1000, ",");
        $column_names = implode(",", $header);

        // Preparar a consulta SQL para inserir dados
        $sql = "INSERT INTO $tabela ($column_names) VALUES ";

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Verificar se a linha está em branco (apenas uma quebra de linha)
            if (count($data) === 1 && trim($data[0]) === '') {
                continue; // Ignorar linhas em branco
            }

            // Escape os valores dos campos para evitar SQL injection
            $escaped_values = array_map(function($value) use ($conn) {
                return "'" . $conn->real_escape_string($value) . "'";
            }, $data);

            $values = implode(",", $escaped_values);
            $sql .= "($values),";
        }
        // Remover a vírgula extra no final da consulta SQL
        $sql = rtrim($sql, ",");

        if ($conn->query($sql) === TRUE) {
            echo "<span class='text-success'>Dados do arquivo '{$caminho_arquivo}' importados com sucesso.</span><br>";
        } else {
            echo "Erro ao importar dados do arquivo '{$caminho_arquivo}': " . $conn->error . "<br>";
        }
        fclose($handle);
    } else {
        echo "Erro ao abrir o arquivo '{$caminho_arquivo}'.<br>";
    }
}

// Esvaziar a tabela antes de importar os dados
esvaziarTabela($conn, $tabela);

// Lista de arquivos na pasta
$arquivos = scandir($pasta);

// Importar os arquivos CSV
foreach ($arquivos as $arquivo) {
    if (pathinfo($arquivo, PATHINFO_EXTENSION) === 'csv') {
        $caminho_arquivo = $pasta . $arquivo;
        importarDados($conn, $tabela, $caminho_arquivo);
    }
}

echo '<a class="btn btn-primary float-left" href="./importar_arquivos.php">Voltar</a>';

// Fechar a conexão com o banco de dados
$conn->close();
?>
</body>
</html>
