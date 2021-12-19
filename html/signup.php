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

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<!--------------------------------- links-------------------------------------->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/form-style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="./js/sistema_de_busca.js"></script>
        
        <!------------------------------------- links end's-------------------------------->
</head>
  <body>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Registre-se</h3>
              <p class="mb-4">Da próxima vez faça login com apenas um clique!</p>
            </div>
            <form action="#" method="post">
			 <div class="form-group first">
                <label for="user_name">Nome</label>
                <input type="text" class="form-control" id="user_name">

              </div>
              <div class="form-group last mb-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="user_email" name="user_email">
                
              </div>
			  <div class="form-group last mb-4">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="user_email" name="password">
                
              </div>
			  <div class="form-group last mb-4">
                <label for="user_id">Matricúla</label>
                <input type="text" class="form-control" id="user_id">
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <span class="ml-auto"><a href="login.php" class="forgot-pass">Já tem uma con=ta ?</a></span> 
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">

              </div>
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

</body>
</html>