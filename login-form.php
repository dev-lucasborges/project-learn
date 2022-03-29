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
        <!--------------------------------- links-------------------------------------->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/login-form.css">
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
                  <a class="nav-link active" href="#">Carteirinha</a>
                </li>
              </ul>
              <form>
                <a class="btn btn-primary" href="sobre.html">Sobre</a>
              </form>
            </div>
          </div>
        </nav>
      </header>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="h3 text-center mt-3 mb-5">Junte-se ao <b>Learn</b></h3>
        
                    <form action="login.php" method="POST">
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Número de matrícula</label>
                          <input name="id" name="text" class="form-control" aria-describedby="emailHelp">
                          <div id="emailHelp" class="form-text">Caso não tenha acesso a sua matrícula, consulte nossa página de <a href="#">Ajuda</a>.</div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Data de nascimento</label>
                          <input name="data" type="text" class="form-control">
                          <div id="emailHelp" class="form-text">Digite no formato <span class="text-warning">dd/mm/aa </span>"dia/mês/ano".</div>
                        </div>
                        <?php
                        if(isset($_SESSION['nao autenticado'])):
                    ?>
                    <div class="notification">
                      Matrícula ou data inválidos
                    </div>
                    <?php
                        endif;
                        unset($_SESSION['nao_autenticado']);
                    ?>
                        <button type="submit" class="btn btn-success">Entrar</button>
                      </form>
                      
                </div>
            </div>
        </div>
    </section>
</body>

</html>