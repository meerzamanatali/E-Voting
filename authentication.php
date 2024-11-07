
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Authentication</title>

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
  <body style="background-color: #212020;">
  
  <div class="container">
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation" style="box-shadow: 0px 0px 10px 8px rgb(6, 26, 250);">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">
          <a href="index.html" class="navbar-brand headerFont text-lg"><strong>R-eVoting</strong></a>
        </div>

        <div class="collapse navbar-collapse" id="example-nav-collapse">
          <ul class="nav navbar-nav">
            <!-- 
            <li><a href="#featuresTab"><span class="subFont"><strong>Features</strong></span></a></li>
            <li><a href="#feedbackTab"><span class="subFont"><strong>Feedback</strong></span></a></li>
            <li><a href="#"><span class="subFont"><strong>About</strong></span></a></li>
          -->
          </ul>
        </div>

      </div> <!-- end of container -->
    </nav>

    
    <div class="container" style="padding-top:150px;">
      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 text-center" style="border:2px solid rgb(255, 253, 253);padding:50px; background-color: #000000; color: white; box-shadow: 0px 0px 10px 8px rgb(73 214 241);">
          <?php
                    

                      // Credentials
                      $hostname= "localhost";
                      $username= "root";
                      $password= "";
                      $database= "db_evoting";
                     
                      // $hostname="localhost";
				              // $username= "id19730309_root";
				              // $password= "5aqpbkPh]BG<Ket5";
				              // $database="id19730309_db_evoting";

                      // UserInput Test
                      function test_input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                       
                        return $data;
                      } 

                      if(empty($_POST['adminUserName']) || empty($_POST['adminPassword']))
                      {
                        $error= "UserName or Password is Recquired.";
                      }
                      else
                      {
                        $admin_username= test_input($_POST['adminUserName']);
                        $admin_password= test_input($_POST['adminPassword']);


                        //Establish Connection
                        $conn= mysqli_connect($hostname, $username, $password, $database);

                        //Check
                        if(!$conn)
                        {
                          die("Connection Failed : ".mysqli_connect_error());
                        }

                        $sql= "SELECT * FROM db_evoting.tbl_admin WHERE admin_username='".$admin_username."' AND admin_password='".$admin_password."'";
                        $query= mysqli_query($conn, $sql);
                        $rowcount = mysqli_num_rows($query);
                        
                        if(mysqli_num_rows($query)==1)
                        {
                          header("location:cpanel.php");
                        }
                        else
                        {
                          $error="Sorry !! Authentication Failed";
                          
                          echo "<p class='alert' style='border:2px solid rgb(255, 253, 253); color:red; box-shadow: 0px 0px 10px 8px red;'><strong>$error</strong></p>";
                          echo "<p class='normalFont'><strong>Your Combination of UserName and Password is In-correct. Better, You contact to the developer of system.</strong> </p>";
                          echo "<br><a href='admin.html' class='btn' style = 'background-color:Yellow; color: black; border 1px solid white; box-shadow: 0px 0px 2px 2px white;'><span class='glyphicon glyphicon-refresh'></span> <strong>Try Again</strong></a>";
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


