<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
$tabela = "notas";
$pasta = "../csv/alunos_com_notas/"; // Caminho para a pasta onde estão os arquivos CSV

// Criar conexão
$conn = $conexao;

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

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

esvaziarTabela($conn, $tabela);

// Função para importar os dados do arquivo CSV para o banco de dados
function importarDados($conn, $tabela, $caminho_arquivo) {
    $sql = "LOAD DATA LOCAL INFILE '{$caminho_arquivo}' INTO TABLE {$tabela} FIELDS TERMINATED BY ',' ENCLOSED BY '\"' IGNORE 1 LINES";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "<span class='text-success'>Dados do arquivo '{$caminho_arquivo}' importados com sucesso.</span><br>";
    } else {
        echo "Erro ao importar dados do arquivo '{$caminho_arquivo}': " . $conn->error . "<br>";
    }
}

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