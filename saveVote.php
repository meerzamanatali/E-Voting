
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
  <body style = 'background-color: black;' >
	<nav class=" navbar navbar-expand-lg navbar-dark bg-dark" style="box-shadow: 0px 0px 10px 8px rgb(6, 26, 250);">
        <a href="index.html" class="navbar-brand headerFont text-lg"><strong style="color: white;">R-eVoting</strong></a>
      </nav>
  	

    
    <div class="container" style="padding-top:150px;">
    	<div class="row">
    		<div class="col-sm-4"></div>
    		<div class="col-sm-4 text-center" style="border:2px solid white;padding:50px; background-color: black; box-shadow: 0px 0px 10px 5px red;">
    			
    			<?php
          

          require('config.php');


					if(isset($_POST["selectedCandidate"])){
					if(isset($_POST["VN"]) && isset($_POST["VID"]) && isset($_POST["VP"]) && isset($_POST["selectedCandidate"]))
					{
						$name= test_input($_POST["VN"]);
						$vid= test_input($_POST["VID"]);
						$vp= test_input($_POST["VP"]);
						$selection= test_input($_POST["selectedCandidate"]);
            $ex = test_input($_POST["tm"]);
					}
				}
				else
				{
					echo "<br>All Field Recquired";
				}
				
       $DB_HOST= "localhost";
       $DB_USER="root";
       $DB_PASSWORD="";
       $DB_NAME="db_evoting";
	

        $conn= @mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME)
        or die("Couldn't Connect to Database :");
				


				$sql= "INSERT INTO db_evoting.tbl_users VALUES('".$vid."','".$name."','".$selection."');";
        $check= "SELECT * FROM db_evoting.tbl_reg WHERE UIN ='".$vid."' AND  Password = '".$vp."' ";
        $status= "SELECT UIN FROM db_evoting.tbl_users WHERE UIN ='".$vid."'";
        $query= mysqli_query($conn, $check);
        $vote_query = mysqli_query($conn, $status);

       
        if(mysqli_num_rows($query)==1 and mysqli_num_rows($vote_query)==0 and $ex >= 0){
				if(mysqli_query($conn, $sql)){
					echo "<img src='images/success.png' width='70' height='70' style='border: 2px solid white; border-radius: 200px; box-shadow: 0px 0px 10px 10px rgb(29, 255, 56);'>";
					echo "<h3 class='specialHead text-center' style = 'color:white;text-shadow: 0 0 3px #000000, 0 0 5px #000000;'><strong> YOU'VE  SUCCESSFULLY   VOTED.</strong></h3>";
					echo "<a href='index.html' class='btn' style = 'color:white; background-color:rgb(29, 255, 56); border:2px solid white; box-shadow: 0px 0px 10px 4px rgb(29, 255, 56);text-shadow: 0 0 3px #000000, 0 0 5px #000000;'> <span class='glyphicon glyphicon-ok'></span> <strong> Finish</strong> </a>";
				}
      }
      elseif(mysqli_num_rows($vote_query)==1)
      {
        
        echo "<img src='images/voted.png' width='100' height='100' style = 'border:2px solid white; border-radius: 200px; box-shadow: 0px 0px 10px 10px green;' >";
        echo "<h3 class='specialHead text-center' style = 'color:white; text-shadow: 0 0 3px #000000, 0 0 5px #000000;'><strong> YOU HAVE CASTED YOUR VOTE</strong></h3>";
        echo "<br><a href='index.html' class='btn' style = 'color:white; background-color:rgb(29, 255, 56); border:2px solid white; box-shadow: 0px 0px 10px 4px rgb(29, 255, 56); text-shadow: 0 0 3px #000000, 0 0 5px #000000;'><strong>VOTED</strong></a>";
      }

      elseif($ex < 0)
      {

        echo "<img src='images/closed.png' width='120' height='70'>";
					echo "<h3 class='specialHead text-center' style = 'color:white; text-shadow: 0 0 3px #000000, 0 0 5px #000000;'><strong> Time is finished, You can't vote now !! </strong></h3>";
					echo "<a href='index.html' class='btn' style = 'color:white; background-color:rgb(29, 255, 56); border:2px solid white; box-shadow: 0px 0px 10px 4px rgb(29, 255, 56);> <span class='glyphicon glyphicon-ok'></span> <strong> Check</strong> </a>";

       
      }
				else
				{
					echo "<img src='images/warn.png' width='100' height='100'>";
					echo "<h3 class='specialHead text-center' style = 'color:white; text-shadow: 0 0 3px #000000, 0 0 5px #000000;'><strong> SORRY! YOU HAVE'T REGISTORED..</strong></h3>";
          echo "<br>";
					echo "<a href='registor.html' class='btn' style = 'box-shadow: 0px 0px 10px 3px blue; background-color:#3117f3; color:white;'> <strong> Register</strong> </a>";
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


