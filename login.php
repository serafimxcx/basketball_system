<?php 
    include("connect.php");
    session_start();

    $user = "";
    $pass = "";
    $user_id="";
    $user_type="";
    $name = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $inptuser = $_POST['txt_username'];
        $inptpass = $_POST['txt_password'];

        $result = $conn->query("select * from tb_users where username like '$inptuser' and pass like '$inptpass'");
        while($row = $result -> fetch_assoc()){
            $user = $row['username'];
            $pass = $row['pass'];
            $user_id = $row['user_id'];
            $user_type = $row['user_type'];
            $name = $row['name'];
        }
        if($inptpass == "" || $inptuser =="") {
            $response = array('success'=>false,'message'=>'Login Failed. Wrong Input. Please Try Again.');

            header('Content-Type: application/json');
            echo json_encode($response);
        }
        elseif ($inptuser == $user && $inptpass == $pass) {
            $response = array('success'=>true, 'message'=>" You are successfully logged in. Welcome $name");
            $_SESSION['username'] = $inptuser;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_type'] = $user_type;
            
            header('Content-Type: application/json');
            echo json_encode($response);
        
        } else {
            $response = array('success'=>false, 'message'=>'Login Failed. Wrong Input. Please Try Again.');

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
?>