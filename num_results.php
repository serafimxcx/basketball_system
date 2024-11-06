<?php 
    $resultadmins = $conn->query("select * from tb_users where user_id > 1");
    $no_of_admins = mysqli_num_rows($resultadmins);

    $resultplayers = $conn->query("select * from tb_players");
    $no_of_players = mysqli_num_rows($resultplayers);

    $resultteams = $conn->query("select * from tb_teams");
    $no_of_teams = mysqli_num_rows($resultteams);

    $resultcoach = $conn->query("select * from tb_coach");
    $no_of_coach = mysqli_num_rows($resultcoach);

    $resultvenue = $conn->query("select * from tb_venue");
    $no_of_venue = mysqli_num_rows($resultvenue);

?>