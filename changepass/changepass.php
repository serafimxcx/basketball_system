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
 
        
        <h1 class="module_title">Change Password</h1>
            
        <hr>

        <div class="change_div">
                <table>
                    <tr>
                        <td style="vertical-align: middle;">Current Password: </td>
                        <td style="vertical-align: middle;"><input type="password" class="form-control txt_pass" id="txt_currentpass"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;">New Password: </td>
                        <td style="vertical-align: middle;"><input type="password" class="form-control txt_pass" id="txt_newpass"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;">Re-enter New Password: </td>
                        <td style="vertical-align: middle;"><input type="password" class="form-control txt_pass" id="txt_newpass2"></td>
                    </tr>
                </table>
                <br><br>
                <button type="button" class="btn btn-warning btn_cpass" id="btn_cancel"> Cancel</button> 
                <button type="button" class="btn btn-success btn_cpass" id="btn_changepass"> Change Password</button>
                

            </div>

        
        

        

    </div>
    
</body>
    <script src="changepass.js"></script>
</html>