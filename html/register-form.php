<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		$user_email = $_POST['user_email'];

		if(!empty($user_name) && !empty($password) && !empty($user_email) && !is_numeric($user_name))
		{

			//save to database
			$query = "insert into users (user_id,user_name,password,user_email) values ('$user_id','$user_name','$password','$user_email')";

			mysqli_query($con, $query);

			header("Location: login-form.php");
			die;
		}else
		{
			echo "Por favor, uma digite uma inforção válida!";
		}
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="../css/form-style.css">

    <title>Registro</title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="../assets/undraw_notebook_re_id0r.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Registre-se</h3>
              <p class="mb-4">Da próxima vez faça login com apenas um clique!</p>
            </div>
            <form method="post">
			 <div class="form-group first mb-1">
               
                <input type="text" class="form-control" name="user_name" placeholder="Nome">

              </div>
              <div class="form-group  mb-1">
                
                <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email">
                
              </div>
			  <div class="form-group  mb-1">
                
                <input type="password" class="form-control" id="user_email" name="password" placeholder="Crie uma senha">
                
              </div>
			  <div class="form-group last mb-1">
                
                <input type="text" class="form-control" id="user_id" placeholder="Matricúla">
                
              </div>
              
              <div class="d-flex mb-2 align-items-center">
                <span class="ml-auto"><a href="login-form.php" class="forgot-pass">Já tem uma conta ?</a></span> 
              </div>

              <input type="submit" value="Registrar" class="btn btn-block btn-primary-tomato">

              </div>
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>