<?php
session_start();
?>



<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learn - Entrar</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <!--------------------------------- links-------------------------------------->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/main__2style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;500;700&display=swap" rel="stylesheet">
    <script src="./js/sistema_de_busca.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        
        <!------------------------------------- links end's-------------------------------->
</head>

<body>

<!------------------------------------- navbar ------------------------------------>
<nav class="mx-3 my-1 navbar navbar-expand-lg navbar-dark bg-dark">
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
              <a class="nav-link active" href="/html/">Ver notas</a>
            </li>
          </ul>
          <form class="d-flex">
            
            <a class="btn btn-primary" href="./login-form.php">Ver notas</a>
          </form>
        </div>
      </div>
    </nav>
    <section class="">
        <div>
            <div>
                <div class="m-4 my-5">
                    <h3 class="h1 frh1">Entre</h3>
                    <?php
                    if(isset($_SESSION['nao_autenticado'])):
                    ?>
                    <div class="notifi my-3 login-form">
                      <p>ERRO: Usuário ou senha inválidos.</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
                    ?>
                    <div class="login-form">
                        <form action="login.php" method="POST">
                            <div class="field">
                                <div class="control">
                                    <input type="email" name="usuario" name="text" class="mb-2 form-control" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input name="senha" class="mb-2 form-control" type="password" placeholder="Senha">
                                </div>
                            </div>
                            <p class="text-muted">Ainda não tem uma conta ?<a href="register-form.php"class="text-primary"> clique aqui</a></p>
                            <button type="submit" class="btn btn-primary gobtn">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>