<?php
// Verificar se foi solicitada a ação de deletar um arquivo
if (isset($_GET['deletar'])) {
    $arquivo_deletar = $_GET['deletar'];
    deletarArquivo($arquivo_deletar);
}

// Verificar se foram enviados arquivos para fazer o upload
if (isset($_FILES['arquivos'])) {
    $pasta_destino = $_POST['pasta_destino'];
    uploadArquivos($pasta_destino);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADM</title>
    <link rel="icon" href="./assets/award.svg" type="image/png">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/adm.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<h1 class="text-center my-5">Olá, Lucas.</h1>

<div class="d-flex align-items-center justify-content-center flex-wrap mb-5 p-2">

<form class="m-2" method="GET" action="">
    <input type="hidden" name="deletar_todos" value="../csv/alunos_com_notas/">
    <button class="btn btn-danger small" type="submit">Deletar Notas</button>
</form>

<form class="m-2" method="GET" action="">
    <input type="hidden" name="deletar_todos" value="../csv/grade_de_aulas/">
    <button class="btn btn-danger  small" type="submit">Deletar Aulas</button>
</form>

<form class="m-2" method="GET" action="">
    <input type="hidden" name="deletar_todos" value="../csv/alunos_com_turma/">
    <button class="btn btn-danger  small" type="submit">Deletar Turmas</button>
</form>

<form class="m-2" method="GET" action="">
    <input type="hidden" name="deletar_todos" value="../csv/alunos_com_dados/">
    <button class="btn btn-danger  small" type="submit">Deletar Todos Alunos</button>
</form>

</div>

<div class="d-flex flex-column align-items-center admForms mb-5">



<?php
// Função para listar arquivos em um diretório
function listarArquivos($diretorio, $extensao)
{
$arquivos = glob($diretorio . "*." . $extensao);
return $arquivos;
}

// Defina aqui o caminho absoluto para a pasta onde os arquivos CSV estão armazenados
$base_dir = "../csv/";

function deletarTodosArquivos($pasta)
{
$files = glob($pasta . "*"); // Obtém todos os arquivos da pasta

foreach ($files as $file) {
    if (is_file($file)) {
        unlink($file); // Deleta o arquivo
    }
}
}

// Verificar se foi solicitada a ação de deletar todos os arquivos
if (isset($_GET['deletar_todos'])) {
$pasta_deletar_todos = $_GET['deletar_todos'];
deletarTodosArquivos($pasta_deletar_todos);
}

// Defina as seções e suas respectivas pastas
$secoes = array(
'Notas' => 'alunos_com_notas',
'Aulas' => 'grade_de_aulas',
'Alunos com turma' => 'alunos_com_turma',
'Alunos com dados' => 'alunos_com_dados'
);



// Função para deletar um arquivo
function deletarArquivo($caminho_arquivo)
{
if (file_exists($caminho_arquivo)) {
    unlink($caminho_arquivo);
    echo "<span class='text-danger'>Arquivo deletado com sucesso!</span><br>";
    // Redirecionar para a mesma página
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
} else {
    echo "Arquivo não encontrado.<br>";
}
}

// Função para fazer o upload de arquivos
function uploadArquivos($pasta_destino)
{
if (!empty($_FILES['arquivos']['name'][0])) {
    $arquivos = $_FILES['arquivos'];

    for ($i = 0; $i < count($arquivos['name']); $i++) {
        $nome_arquivo = $arquivos['name'][$i];
        $caminho_temporario = $arquivos['tmp_name'][$i];

        if (move_uploaded_file($caminho_temporario, $pasta_destino . $nome_arquivo)) {
            echo "<span class='text-success'>Arquivo {$nome_arquivo} enviado com sucesso!</span><br>";
        } else {
            echo "Erro ao enviar o arquivo {$nome_arquivo}.<br>";
        }
    }

    // Redirecionar para a mesma página
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
} else {
    echo "Nenhum arquivo selecionado.<br>";
}
}

// Loop para listar os arquivos em cada seção e adicionar botões de deletar e upload
foreach ($secoes as $secao => $pasta) {
echo "<h2>{$secao}</h2>";

// Caminho completo para a pasta da seção
$dir_path = $base_dir . $pasta . "/";

// Lista de arquivos CSV na pasta da seção
$arquivos = listarArquivos($dir_path, 'csv');

if (count($arquivos) > 0) {
    echo '<table class="table table-bordered">';
    foreach ($arquivos as $arquivo) {
        echo "<tr><td>{$arquivo}</td> <td><a class='text-danger' href=\"?deletar={$arquivo}\">Deletar</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>Nenhum arquivo nesta seção.</p>";
}


// Formulário para fazer o upload de arquivos na pasta da seção
echo "<form action=\"\" method=\"post\" enctype=\"multipart/form-data\">";
echo "<input class='form-control' type=\"file\" name=\"arquivos[]\" multiple><br>";
echo "<input type=\"hidden\" name=\"pasta_destino\" value=\"{$dir_path}\">";
echo "<input id='sub' type=\"submit\" value=\"Enviar\">";
echo "</form>";
}

// Verificar se foi solicitada a ação de deletar um arquivo
if (isset($_GET['deletar'])) {
$arquivo_deletar = $_GET['deletar'];
deletarArquivo($arquivo_deletar);
}

// Verificar se foram enviados arquivos para fazer o upload
if (isset($_FILES['arquivos'])) {
$pasta_destino = $_POST['pasta_destino'];
uploadArquivos($pasta_destino);
}
?>

<div class="btn-group mt-5" role="group" aria-label="Button group with nested dropdown">
  <a href="../adm/atualizar_notas.php"><button type="button" class="btn btn-dark mx-1">Notas</button></a>
  <a href="../adm/atualizar_grade.php"><button type="button" class="btn btn-dark mx-1">Aulas</button></a>
  <a href="../adm/atualizar_turmas.php"><button type="button" class="btn btn-dark mx-1">Turmas</button></a>
  <a href="../adm/atualizar_dados.php"><button type="button" class="btn btn-dark mx-1">Dados</button></a>
</div>

</div>


</body>
</html>