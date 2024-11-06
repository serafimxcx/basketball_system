<?php 
include("../connect.php");

$queryusername = "select * from tb_users";

$resultusername = mysqli_query($conn, $queryusername);

$exist = 0;

while($row = mysqli_fetch_assoc($resultusername)){
    if(mysqli_real_escape_string($conn, $_REQUEST["txt_username"]) == $row["username"]){
        $exist = 1;
        echo "Username already exists.";
    }else{
        $exist = 0;
    }
}

if($exist == 0){
    $query="insert into tb_users (name, username, pass) values(
        '".mysqli_real_escape_string($conn, $_REQUEST["txt_name"])."',
        '".mysqli_real_escape_string($conn, $_REQUEST["txt_username"])."',
        '".mysqli_real_escape_string($conn, $_REQUEST["txt_password"])."'
    )";
    
    mysqli_query($conn, $query);
}



echo "";
?>