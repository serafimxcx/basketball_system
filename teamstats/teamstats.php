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
            <h1 class="module_title">Team Stats</h1>
            </div>

            <div class="col-sm-6 btnprint_col" >
            <h1><button type="button" class="btn btn-primary" id="print_teamstats">Print</button></h1>
            </div>
        </div>
        
            
        <hr>

        <div id="teamstats_result">

        </div>
        

        

    </div>
    
</body>
    <script src="teamstats_script.js"></script>
</html>