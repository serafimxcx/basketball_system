<?php 
    include("../navbar.php");

    if ($_SESSION['user_type'] == "Admin") {
        //do nothing
    }else{
        // Redirect to the login page
        echo "<script>alert('You dont have access to this page.'); window.location.href='/basketball_system/dashboard.php';</script>";
    }
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
    <br><br><br><br>
    <div id="container">
        <div class="row">
            <div class="col-sm-6 input_col">
                <form onload="return false;">
                    <div id="coach_manage">
                        <input type="hidden" name="txt_user_id" id="txt_user_id">
                        <h1 class="module_title">User Administration</h1>
                        <h4>Add New User</h4>
            
                        <hr>
                        <table width="100%">
                            <tr>
                                <td>Name:</td>
                                <td><input type="text" data_type="txt" name="txt_name" class="form-control txt_name" id="txt_name" ></td>
                            </tr>
                            <tr>
                                <td>Username:</td>
                                <td><input type="text" data_type="txt" name="txt_username" class="form-control txt_name" id="txt_username" ></td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td><input type="password" data_type="txt" name="txt_username" class="form-control txt_name" id="txt_password" ></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    
                                    <button type="button" class="btn btn_coach btn-success" id="btn_save">Save</button>
                                    <button type="button" class="btn btn_coach btn-warning" id="btn_cancel">Cancel</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>

            </div>
            <div class="col-sm-6 records_col">
                <div id="users_result" class="container_results">
                    
                </div>

            </div>
        </div>

        
        

        
        

        

    </div>
    
</body>
    <script src="useradmin.js"></script>
</html>