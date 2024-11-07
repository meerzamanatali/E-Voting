
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <style>
      .headerFont{
        font-family: 'Ubuntu', sans-serif;
        font-size: 24px;
      }

      .subFont{
        font-family: 'Raleway', sans-serif;
        font-size: 14px;
        
      }
      
      .specialHead{
        font-family: 'Oswald', sans-serif;
      }

      .normalFont{
        font-family: 'Roboto Condensed', sans-serif;
      }
    </style>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body style = 'background-color:black'>   <!-- 1st -->
	
	<div class="container">
  	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse
    " role="navigation" style="box-shadow: 0px 0px 10px 8px rgb(6, 26, 250);"> <!-- 2nd -->
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">
          <a href="index.html" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
        </div>


      </div> <!-- end of container -->
    </nav>

    
    <div class="container" style="padding-top:150px;"> 
    	<div class="row"> 
    		<div class="col-sm-4"></div>
    		<div class="col-sm-4 text-center" style="border:2px solid white;padding:50px; background-color:black; box-shadow: 0px 0px 10px 5px red;"> <!-- 3rd -->
    			
    		<?php
                    

                      // Credentials
                      $hostname= "localhost";
                      $username= "root";
                      $password= "";
                      $database= "db_evoting";


                      // UserInput Test
                      function test_input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                       
                        return $data;
                      } 

                      if(empty($_POST['VN']) || empty($_POST['VID']) || empty($_POST['VP']))
                      {
                        $error= "UserName or Password is Recquired.";
                      }
                      
                        $user_username= test_input($_POST['VN']);
                        $user_id= test_input($_POST['VID']);
                        $user_password= test_input($_POST['VP']);


                        //Establish Connection
                        $conn= mysqli_connect($hostname, $username, $password, $database);

                        //Check
                        if(!$conn)
                        {
                          die("Connection Failed : ".mysqli_connect_error());
                        }
                        else {

                        $sql= "SELECT * FROM db_evoting.tbl_data WHERE UIN='".$user_id."' ";
                        $query= mysqli_query($conn, $sql);
                        $ins = "INSERT INTO db_evoting.tbl_reg VALUES('".$user_username."','".$user_id."','".$user_password."');";
                        $dup= "SELECT * FROM db_evoting.tbl_reg WHERE UIN='".$user_id."' ";
                        $dup_query = mysqli_query($conn, $dup);
                        if(mysqli_num_rows($query)==1 && mysqli_num_rows($dup_query)==0){
                          if(mysqli_query($conn, $ins))
                        {

                          
                          echo "<img src='images/success.png' alt='' width='100' height='100' style='border: 2px solid white; border-radius: 200px; box-shadow: 0px 0px 10px 10px rgb(29, 255, 56);'>";
                          echo "<h3 class='text-info specialHead text-center' style = 'color:white; text-shadow: 0 0 3px #000000, 0 0 5px #000000;'><strong> YOU'VE  SUCCESSFULLY REGISTERED.</strong></h3>";
                          echo "<a href='index.html' class='btn' style = 'color:white; background-color:rgb(29, 255, 56); border:2px solid white; box-shadow: 0px 0px 10px 4px rgb(29, 255, 56); text-shadow: 0 0 3px #000000, 0 0 5px #000000;'> <span class='glyphicon glyphicon-ok'></span> <strong> Finish</strong> </a>";
            
                        }
                       } // Duplicate Checking Close
                    
                        elseif(mysqli_num_rows($dup_query)>0)
                        {
                          echo "<img src='images/warn.png' width='100' height='100'>";
                          echo "<h3 class='text-info specialHead text-center'><strong style = 'color:white;'> YOU ARE ALREADY REGISTERED</h3>";
                          echo "<br><a href='registor.html' class='btn btn-danger' style = 'background-color:blue; box-shadow: 0px 0px 10px 3px white; text-shadow: 0 0 3px #000000, 0 0 5px #000000;'><span class='glyphicon glyphicon-refresh'></span> <strong>Cast Your Vote</strong></a>";
                        } //Already Displayed Close
                
                        else
                        {
                          echo "<img src='images/warn.png' width='100' height='100'>";
                          echo "<h3 class='text-info specialHead text-center'><strong style = 'color:white; text-shadow: 0 0 3px #000000, 0 0 5px #000000;'> YOU ARE NOT STUDENT OF THIS COLLEGE</strong></h3>";
                          echo "<br><a href='registor.html' class='btn btn-danger' style = 'background-color:red; box-shadow: 0px 0px 10px 3px white; text-shadow: 0 0 3px #000000, 0 0 5px #000000;'><span class='glyphicon glyphicon-refresh'></span> <strong>Try Again</strong></a>";
                        }

                        mysqli_close($conn);

                      }
              
                    
          ?>
    			
    		</div>
    		<div class="col-sm-4"></div>
    	</div>
    </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>