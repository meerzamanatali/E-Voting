<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Control Panel</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
   

    <style>
      body
      {
        background-color:#272727;
      }
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
      @media (max-width:420px) {
       #status {
              width: 390px;
              margin-left: -77px;
              padding-left: 0px;
       }
       #myChart {
                width: 300px;
       }
    }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation" style="box-shadow: 0px 0px 10px 8px rgb(6, 26, 250);">
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <div class="navbar-header">
               <a href="cpanel.php" class="navbar-brand headerFont text-lg"><strong>R-eVoting</strong></a>
            </div>

            <div class="collapse navbar-collapse" id="example-nav-collapse">
                <ul class="nav navbar-nav">
                    
                    <li><a href="nomination.html"><span class="subFont"><strong>Nomination's List</strong></span></a></li>
                    <li><a href="changePassword.php"><span class="subFont"><strong>Admin's Password</strong></span></a></li>
                    <li><a><span class="subFont"><strong>Add Candidate</strong></span></a></li> 
                    <li><a href=""><span class="subFont" onclick="setTime()"><strong>Set Time</strong></span></a></li> 
                    <li><a href=""><span class="subFont"><strong>Feedback Report</strong></span></a></li> 
                
                </ul>
                   <span class="normalFont"><a href="index.html" class="btn navbar-right navbar-btn" style = "background-color: rgb(12, 255, 89); color: rgb(255, 255, 255); font-size: 15px; font-weight: bold; border: 1px solid white; box-shadow: 0px 0px 4px 2px rgb(252, 252, 252); text-shadow: 0 0 3px black, 0 0 5px black;"><strong>Sign Out</strong></a></span></button>
            </div>

        </div> <!-- end of container -->
    </nav>

        <div class="container" style="padding:100px;">
            <div class="row" id="status">
                <div class="col-md-10" style="border:3.5px solid white; background-color:black; color:white; box-shadow: 0px 0px 10px 3px rgb(252, 252, 252);">
                    <div class="page-header" style="border-bottom:2.5px solid black;">
                         <h2 class="specialHead">CONTROL PANEL</h2>
                         <p class="normalFont">This is Administration Panel.</p>
                    </div>

                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
      
      
                    <?php
                    require 'config.php';

                    $KK=0;
                    $MS=0;
                    $ZAM=0;
                    $AK=0;

                    $conn = mysqli_connect($hostname, $username, $password, $database);
                    if(!$conn)
                    {
                       echo "Error While Connecting.";
                    }
                    else
                    {

                      //Khizar Ali
                      $sql ="SELECT * FROM db_evoting.tbl_users WHERE Voted_For='KK'";
                      $result= mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result)>0)
                    {
                        while($row= mysqli_fetch_assoc($result))
                    {
                        if($row['Voted_For'])
                           $KK++;
                    }

                    $kk_value= $KK*0.057;
                    }

                    // Musaib Shaikh
                     $sql ="SELECT * FROM db_evoting.tbl_users WHERE Voted_For='MS'";
                     $result= mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result)>0)
                     {
                        while($row= mysqli_fetch_assoc($result))
                     {
                        if($row['Voted_For'])
                         $MS++;
                     }


                     $ms_value= $MS*0.057;

                     }

                    // Zamanat Ali
                     $sql ="SELECT * FROM db_evoting.tbl_users WHERE Voted_For='ZAM'";
                     $result= mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result)>0)
                     {
                       while($row= mysqli_fetch_assoc($result))
                     {
                       if($row['Voted_For'])
                         $ZAM++;
                     }


                      $zam_value= $ZAM*0.057;

                     }

                    // Khan Asiba
                    $sql ="SELECT * FROM db_evoting.tbl_users WHERE Voted_For='AK'";
                    $result= mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result)>0)
                     {
                         while($row= mysqli_fetch_assoc($result))
                     {
                         if($row['Voted_For'])
                         $AK++;
                     }


                     $ak_value= $AK*0.057;

                    }
                

                     echo "<hr>";

                     $total=0;

                    // Total
                    $sql ="SELECT * FROM db_evoting.tbl_users";
                    $result= mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result)>0)
                     {
                         while($row= mysqli_fetch_assoc($result))
                     {
                         if($row['Voted_For'])
                           $total++;
                     }


                        $tptal= $total*10;

                    echo "<strong>Total Number of Votes</strong><br>";
                    echo "
                    <div class='text' style = 'text-shadow: 0 0 8px red, 0 0 6px green;'>
                    <h2 class='normalFont'><b>TOTAL VOTES : $total </b></h2>
                    </div>";
                    }

                   }
                   ?>
                </div>
            </div>
        </div>
   

    <h2 id="htime">XYZ</h2>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    var kk = "<?php echo $KK; ?>";
    var ms = "<?php echo $MS; ?>";
    var zam = "<?php echo $ZAM; ?>";
    var ak = "<?php echo $AK; ?>";
    var xValues = ["KHIZAR ALI", "MUSAIB SHAIKH", "ZAMANAT ALI", "KHAN ASIBA"];
    var yValues = [kk, ms, zam, ak];
    var barColors = ["red", "green","blue","orange"];

    new Chart("myChart", {
    type: "horizontalBar",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "Voting Result"
        }
    }
    });
    </script>
    <script src="time.js"></script>
</body>
</html>
