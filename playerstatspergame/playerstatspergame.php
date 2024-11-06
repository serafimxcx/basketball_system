<?php 
    include("../navbar.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Basketball System</title>
</head>
<body>
    <br><br><br>
    <div id="container">
 
        <div class="row">
            <div class="col-sm-6">
            <h1 class="module_title">Player Stats (Per Game)</h1>

            <table>
            <tr>
                <td>Game Schedules:</td>
                <td><select name="slct_gamesched" class="form-control txt_name"  id="slct_gamesched"></select></td>
            </tr>
            </table>
            </div>

            <div class="col-sm-6 btnprint_col" >
            <h1><button type="button" class="btn btn-primary" id="print_statspergame">Print</button></h1>
            </div>
        </div>
        
        
            
        <hr>


        <div class="stats_result">
            <div class="stats_title">Hometeam</div><br>
            <div  class="playerstats_result" id="homeplayerstats_result" >

            </div>
            <br>
        </div>

        <br><hr><br>

        <div class="stats_result">
            <div class="stats_title">Awayteam</div><br>
            <div class="playerstats_result" id="awayplayerstats_result" >

            </div>
            <br>
        </div>
        

        

    </div>
    
</body>
    <script src="playerstats_script.js"></script>
</html>