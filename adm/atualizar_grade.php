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
$tabela = "aulas";
$pasta_grade_aulas = "../csv/grade_de_aulas/";

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
        echo "<span class='text-secondary'> Tabela $tabela esvaziada com sucesso!</span><br>";
        return true;
    } else {
        echo "Erro ao esvaziar tabela $tabela: " . mysqli_error($conexao) . "<br>";
        return false;
    }
}

esvaziarTabela($conn, $tabela);

function importarGradeAulas($conexao, $diretorio)
{
    $arquivos = glob($diretorio . "/*.csv");

    foreach ($arquivos as $arquivo) {
        if (importarDadosGradeAulas($conexao, $arquivo)) {
            echo "<span class='text-success'> Arquivo $arquivo importado com sucesso!</span><br>";
        } else {
            echo "Erro ao importar o arquivo $arquivo!<br>";
        }
    }
}

function importarDadosGradeAulas($conexao, $arquivo)
{
    if (($handle = fopen($arquivo, "r")) !== FALSE) {
        // Pular as 4 primeiras linhas, que contêm os cabeçalhos
        for ($i = 0; $i < 4; $i++) {
            fgetcsv($handle);
        }

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $turma = mysqli_real_escape_string($conexao, $data[0]);
            $sala_aula = mysqli_real_escape_string($conexao, $data[1]);
            $ordem = empty($data[2]) ? 0 : mysqli_real_escape_string($conexao, $data[2]); // Verifica se o valor é vazio e atribui zero se for
            $dia_semana = mysqli_real_escape_string($conexao, $data[3]);
            $tipo_aula = mysqli_real_escape_string($conexao, $data[4]);
            $textbox70 = mysqli_real_escape_string($conexao, $data[5]);
            $textbox24 = mysqli_real_escape_string($conexao, $data[6]);
            $matricula = mysqli_real_escape_string($conexao, $data[7]);
            $nome_docente = mysqli_real_escape_string($conexao, $data[8]);

            // Insira os dados no banco de dados (você precisa criar a tabela de grade de aulas)
            $query = "INSERT INTO aulas (turma, sala_aula, ordem, dia_semana, tipo_aula, textbox70, textbox24, matricula, nome_docente) 
                      VALUES ('$turma', '$sala_aula', '$ordem', '$dia_semana', '$tipo_aula', '$textbox70', '$textbox24', '$matricula', '$nome_docente')";
            mysqli_query($conexao, $query);
        }
        fclose($handle);
        return true;
    } else {
        return false;
    }
}


// Importar os arquivos CSV da grade de aulas
importarGradeAulas($conexao, $pasta_grade_aulas);

echo '<a class="btn btn-primary float-left" href="./importar_arquivos.php">Voltar</a>';

// Fechar a conexão com o banco de dados
$conn->close();
?>

</body>
</html>
