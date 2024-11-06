<?php 
    include("../connect.php");

    //add players in gameplayers
    $queryschedID = "select * from tb_gamesched order by gamesched_id DESC LIMIT 1";

    $resultID = mysqli_query($conn, $queryschedID) or die(mysqli_error($conn));

    while($row = mysqli_fetch_assoc($resultID)){
        $gameschedID = $row["gamesched_id"];

        $queryplayerID = "";

        $jsondata = $_POST["awayteam_arr"];
        $playerStatus = json_decode($jsondata, true);

        foreach($playerStatus as $player){
            $playerId = $player["playerId"];
            $isInjured = $player["isInjured"];
            $isFirstFive= $player["isFirstFive"];
            $selectedPosition= $player["selectedPosition"];
            $awayTeam= $player["awayTeam"];

            $query = "insert into tb_gameplayers (gamesched_id, team_id, player_id, position_id, isFirstfive, isInjured) values($gameschedID, $awayTeam, $playerId, $selectedPosition, $isFirstFive, $isInjured)";

            mysqli_query($conn, $query);
        }

    }
?>