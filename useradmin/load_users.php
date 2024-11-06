<?php 
    include("../connect.php");


    $query = "select * from tb_users where user_id > 1 order by user_id DESC";
    

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $loadusers = "<table class='table table-hover table_files'> ";
    $loadusers .= "<tr>
                    <th class='col-xs-1 text-center'>Name</th>
                    <th class='col-xs-1 text-center'>Username</th>
                    <th class='col-xs-1'></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $loadusers .= "<tr style='cursor:pointer;' class='user_records' user_id='".$row["user_id"]."'>
                            <td style='vertical-align: middle;'>".stripslashes($row["name"])."</td>
                            <td style='vertical-align: middle;'>".stripslashes($row["username"])."</td>
                            <td style='vertical-align: middle;'><button type='button' class='remove-user btn-danger remove_item' user_id='".$row["user_id"]."'>X</button></td>
                        </tr>";
    }

    $loadusers .= "</table>";

echo $loadusers;
?>