<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_email = $_POST['user_email'];
		$password = $_POST['password'];

		if(!empty($user_email) && !empty($password) && !is_numeric($user_email))
		{

			//read from database
			$query = "select * from users where user_email = '$user_email' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index2.html");
						die;
					}
				}
			}
			
			echo "Email ou senha incorretos!";
		}else
		{
			echo "Email ou senha incorretos!";
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
              <h3>Entre</h3>
              <p class="mb-4">Só com um clique! Eu disse que seria fácil :)</p>
            </div>
            <form method="post">
			 <div class="form-group first mb-1">
                
                <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email">
                
              </div>
			  <div class="form-group last mb-1">
                
                <input type="password" class="form-control" id="user_email" name="password" placeholder="Senha">
                
              </div>
              
              <div class="d-flex mb-2 align-items-center">
                <span class="ml-auto"><a href="register-form.php" class="forgot-pass">Ainda não tem uma conta ?</a></span> 
              </div>

              <input type="submit" value="Entrar" class="btn btn-block btn-primary-tomato">

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