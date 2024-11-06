<?php 
    include("connect.php");
    session_start();

    $name="";
    $user_id="";

    if(!isset($_SESSION['user_id'])) {
        echo "<script>alert('Access Denied. Please Login your Account.');
        window.location.href='/basketball_system/index.php'</script>";
    }else{
        $user_id = $_SESSION["user_id"];
        $query="select * from tb_users where user_id='$user_id'";

        $result=mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($result)){
            $name = $row["name"];
        }
    }



    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        #btn_nav{
            background-color: transparent;
            border: none;
            color: white;
            display: none;
        }

        .navbar{
            background-color: #000361;
            border-bottom: none;
            color: white;
            z-index: 80;
        }

        .navbar-nav{
            display: block;
            color: white;
            
        }

        .navbar-inverse .navbar-nav>li>a,
        .navbar-inverse .navbar-brand {
            color: white;
        }

        .navbar-inverse .navbar-nav>li>a:hover {
            background-color: #000154;
        }

        .navbar-inverse .navbar-nav>.open>a,
        .navbar-inverse .navbar-nav>.open>a:focus,
        .navbar-inverse .navbar-nav>.open>a:hover,
        .navbar-inverse .navbar-nav>.open>a:active {
            color: white;
            background-color: #000154;
        }

         /* width */
         ::-webkit-scrollbar {
        width: 10px;
        height: 10px;
        }

     

        /* Track */
        ::-webkit-scrollbar-track {
        background: transparent;
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #DEDEDE; 
        border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #DEDEDE; 
        }
       
    

     
        @media (max-width: 750px){
            #btn_nav{
                display: block;
            }

            .navbar-nav{
                display: none;
            }

        
        }
    </style>
  </head>

  <body>

  <nav class="navbar navbar-inverse navbar-fixed-top" >
        <div class="container-fluid" >
        <div class="navbar-header"  >
            <table>
                <tr>
                    <td><a class="navbar-brand" href="/basketball_system/dashboard.php">Basketball System - <?php echo $name; ?></a></td>
                    <td><button type="button" id="btn_nav"><i class="bi bi-list"></i></button></td>
                </tr>
            </table>
             
        </div>
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" >Files
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/basketball_system/coaches/coaches.php">Coaches</a></li>
                    <li><a href="/basketball_system/teams/teams.php">Teams</a></li>
                    <li><a href="/basketball_system/positions/positions.php">Positions</a></li>
                    <li><a href="/basketball_system/players/players.php">Players</a></li>
                    <li><a href="/basketball_system/venue/venue.php">Venue</a></li>
                    <li><a href="/basketball_system/schedule/schedule.php">Schedule</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" >Transactions
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/basketball_system/gamestats/gamestats.php">Game Stats</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" >Reports
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/basketball_system/teamstanding/teamstanding.php">Team Standings</a></li>
                    <li><a href="/basketball_system/teamstats/teamstats.php">Team Stats</a></li>
                    <li><a href="/basketball_system/playerstatspergame/playerstatspergame.php">Player Stats (Per Game)</a></li>
                    <li><a href="/basketball_system/playerstatsallgames/playerstatsallgames.php">Player Stats (All Games)</a></li>
                    
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" >Utilities
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/basketball_system/changepass/changepass.php">Change Password</a></li>
                    <li style='<?php
                    
                    if($_SESSION["user_type"] == "User"){
                        echo "display:none";
                    }else{
                        echo "display:block";
                    }

                    ?>'><a href="/basketball_system/useradmin/useradmin.php">User Administration</a></li>
                </ul>
            </li>
        </ul>

    
            
        
        <ul class="nav navbar-nav navbar-right">
            <li><a onclick="Logout()"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>

        </div>
  </nav>
  </body>

    <script>
        $(function(){
            $("#btn_nav").click(function(){
                $(".navbar-nav").toggle();
            });

            
            
        });
        
      function Logout(){
          if(confirm("Are you sure you want to logout your account?")){
            $.ajax({
                "type": 'POST',
                "url": '/basketball_system/logout.php',
                "success": function(response){
                   
                      alert("Successfully Logged out.");
                      window.location.href = '/basketball_system/index.php';
                    
                    
                    }
            });
          }
        }

    </script>
</html>
