<?php 
include ('verifica_login.php');
include ('conexao.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link rel="icon" href="./assets/award.svg" type="image/png">
        <!--------------------------------- links-------------------------------------->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/painel.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;500;700&display=swap" rel="stylesheet">
    <script src="./js/sistema_de_busca.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/15abb0f24e.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rellax/1.12.1/rellax.min.js" integrity="sha512-f5HTYZYTDZelxS7LEQYv8ppMHTZ6JJWglzeQmr0CVTS70vJgaJiIO15ALqI7bhsracojbXkezUIL+35UXwwGrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!------------------------------------- links end's-------------------------------->
</head>
<body>

<header>
        <nav class="navbar navbar-expand-lg navbar-dark " id="mainNav" role="navigation">
          <div class="container-fluid">
            <a class="navbar-brand logo" href="#">Learn</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="index.html">Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./html/library.html">Biblioteca</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="./html/index2.html">Carteirinha</a>
                </li>
              </ul>
              <form>
                <a class="btn btn-primary" href="./login-form.php">Login</a>
              </form>
            </div>
          </div>
        </nav>
      </header>

<h1 class="h3 text-center">Sua carteirinha</h1>

    <div class="boxcard container-fluid mx-auto">
        

			<?php
			
			$usuario = $_SESSION['usuario'];

			$sql = mysqli_query($conexao, "SELECT * FROM alunos WHERE id = '$usuario'");
		    while($col = mysqli_fetch_assoc($sql)){
                
                echo "<h1 class='card-title'>CARTEIRA DE ESTUDANTE</h1>";
				echo "<h2 class='card-subtitle'>CE LUIZ REID<h1>";
                echo "<h1 class='brand'>LUIZ REID</h1>";
			    echo "<ul class='info'>";
                echo "<li class='text-muted'>NOME</li>";
			    echo "<li>".$col['nome']."</li>";
                echo "<li class='text-muted'>DATA DE NASCIMENTO</li>";
			    echo "<li>".$col['data']."</li>";
                echo "<li class='text-muted'>TURNO</li>";
			    echo "<li>".$col['turno']."</li>";
                echo "<li class='text-muted'>CURSO</li>";
				echo "<li>".$col['curso']."</li>";
			    echo "</ul>";
                echo '<div class="logoluiz"> <img src="luizlogo.png" <="" img="" style="width: 100px;"></div>';
                echo '<div class="picture"> <img draggable="false" class="img-fluid imgg" src='.$col["path"].'></div>';
                echo "<div class='pic-info'>VALIDO ATÉ</div>";
                echo "<div class='pic-info2'>12/22</div>";
			}	
			?>
 </div>
</body>
</html>
