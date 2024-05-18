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
$tabela = "turmas";
$pasta = "../csv/alunos_com_turma/";

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

function atualizarTurmas($conexao, $tabela, $pasta)
{
    esvaziarTabela($conexao, $tabela);

    // Função para importar os dados do arquivo CSV para o banco de dados
    function importarDados($conn, $tabela, $caminho_arquivo) {
        if (($handle = fopen($caminho_arquivo, "r")) !== FALSE) {
            // Pular a primeira linha, que contém os cabeçalhos
            fgetcsv($handle);
    
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Verificar se o array possui o número correto de elementos
                if (count($data) >= 6) {
                    $matricula = mysqli_real_escape_string($conn, $data[0]);
                    $aluno1 = mysqli_real_escape_string($conn, $data[1]);
                    $turma_principal = mysqli_real_escape_string($conn, $data[2]);
                    $situacao = mysqli_real_escape_string($conn, $data[3]);
                    $disciplinas_progressao = mysqli_real_escape_string($conn, $data[4]);
                    $turmas_progressao = mysqli_real_escape_string($conn, $data[5]);
    
                    // Insira os dados no banco de dados
                    $query = "INSERT INTO $tabela (MATRICULA, ALUNO1, TURMA_PRINCIPAL, SITUACAO, DISCIPLINAS_PROGRESSAO, TURMAS_PROGRESSAO) 
                              VALUES ('$matricula', '$aluno1', '$turma_principal', '$situacao', '$disciplinas_progressao', '$turmas_progressao')";
                    mysqli_query($conn, $query);
                } else {
                    echo "Aviso: Linha com número incorreto de elementos no arquivo '{$caminho_arquivo}'. A linha será ignorada.<br>";
                }
            }
            fclose($handle);
        } else {
            echo "Erro ao abrir o arquivo '{$caminho_arquivo}'.";
        }
    }

    // Lista de arquivos na pasta
    $arquivos = scandir($pasta);

    // Importar os arquivos CSV
    foreach ($arquivos as $arquivo) {
        if (pathinfo($arquivo, PATHINFO_EXTENSION) === 'csv') {
            $caminho_arquivo = $pasta . $arquivo;
            importarDados($conexao, $tabela, $caminho_arquivo);
        }
    }
}

echo '<a class="btn btn-primary float-left" href="./importar_arquivos.php">Voltar</a>';


// Verificar se o botão de atualização foi pressionado

    atualizarTurmas($conn, $tabela, $pasta);


// Fechar a conexão com o banco de dados
$conn->close();
?>


    
</body>
</html>