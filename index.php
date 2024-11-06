
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>User Login</title>
</head>
<body>
    <div id="login-container">
        <div id="logindiv">
        <form onload="return false;">
        
            <div id="logindiv2">
                <table width="100%" >
                    
                    <tr>
                        <td colspan="2" style="text-align: center;"><h1 style=" font-weight: bold;">USER LOGIN</h1><h4>Basketball System</h4><br></td>
                    </tr>
                    <tr>
                        <td ><i class="bi bi-person-fill login_icon"></i><label>Username: </label></td>
                        <td style='padding-top: 15px;'><input type="text" name="txt_username" class="form-control" id="txt_username" required><br></td>
                    </tr>
                    <tr>
                        <td ><i class="bi bi-lock-fill login_icon"></i> <label>Password: </label></td>
                        <td style=' padding-top: 15px;'><input type="password" name="txt_password" class="form-control" id="txt_password" required><br></td>
                    </tr>
                </table>
            </div>
            
            <button type="button" class="loginbtn" id="btn_login">Login Account</button>
          
            
            
        </form>
        </div>
    </div>
</body>
<script>
    $(function(){
        $("#btn_login").click(function(){
            var cParam = "";

            cParam = "txt_username="+$('#txt_username').val();
            cParam += "&txt_password="+$('#txt_password').val();
        
            $.ajax({
            "type": 'POST',
            "url": 'login.php',
            "data": cParam,
            "dataType": 'json',
            "success": function (response) {
                if(response.success){
                    alert(response.message);
                    window.location.href = 'dashboard.php';
                }else{
                    alert(response.message);
                }
                
                }
            });
        });
    });
</script>
</html>