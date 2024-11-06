<?php 
include("../connect.php");

$gamesched_id = $_POST["gamesched_id"];
$hometeam_id = $_POST["hometeam_id"];
$awayteam_id = $_POST["awayteam_id"];
$home_total_score = intval($_POST["home_total_score"]);
$away_total_score = intval($_POST["away_total_score"]);

if($home_total_score > $away_total_score){
    $queryhome = "insert into tb_teamstanding (gamesched_id, team_id, home_win, points_for, points_against) values('$gamesched_id', '$hometeam_id', '1', '$home_total_score', '$away_total_score')";

    $queryaway = "insert into tb_teamstanding (gamesched_id, team_id, away_lose, points_for, points_against) values('$gamesched_id', '$awayteam_id', '1', '$away_total_score', '$home_total_score')";

}elseif($home_total_score < $away_total_score){
    $queryhome = "insert into tb_teamstanding (gamesched_id, team_id, home_lose, points_for, points_against) values('$gamesched_id', '$hometeam_id', '1', '$home_total_score', '$away_total_score')";

    $queryaway = "insert into tb_teamstanding (gamesched_id, team_id, away_win, points_for, points_against) values('$gamesched_id', '$awayteam_id', '1', '$away_total_score', '$home_total_score')";
}

mysqli_query($conn, $queryhome);
mysqli_query($conn, $queryaway);

$querylocksched = "update tb_gamesched set isLocked = '1' where gamesched_id='$gamesched_id'";
mysqli_query($conn, $querylocksched);




echo "";
?>