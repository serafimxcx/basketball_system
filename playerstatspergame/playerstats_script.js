var gameSchedID = "";
var isLocked = 0;

$(function(){
    OptionSchedule();


    $("#slct_gamesched").change(function(){
        gameSchedID = $("#slct_gamesched").val();
        var selected = $(this).find('option:selected');
        
        isLocked = selected.attr("isLocked");

        LoadHomeTeam(gameSchedID);
        LoadAwayTeam(gameSchedID);
		
	});

    $("#print_statspergame").click(function() {
        if(isLocked == 0){
            alert("Stats is not yet ready.");
        }else{
            var cFile = "print_statspergame.php?sched_id="+$("#slct_gamesched").val();
		    window.open(cFile, "_blank");
        }
		
	});
});

function OptionSchedule(){
    $.ajax({
        "type":"POST",
        "url":"../gamestats/option_sched.php",
        "success": function(text){
            $("#slct_gamesched").html(text);
        }
    });
}

function LoadHomeTeam(gameSchedID){
    var cParam = "";

    cParam = "sched_id="+ gameSchedID;

    $.ajax({
        "type":"POST",
        "url":"load_stathome.php",
        "data": cParam,
        "success": function(text){
            $("#homeplayerstats_result").html(text);
        }
    });
}

function LoadAwayTeam(gameSchedID){
    var cParam = "";

    cParam = "sched_id="+ gameSchedID;

    $.ajax({
        "type":"POST",
        "url":"load_stataway.php",
        "data": cParam,
        "success": function(text){
            $("#awayplayerstats_result").html(text);
        }
    });
}

function ErrorImagePlayer(player_id){
    $("#img_player"+player_id).attr("src", "https://drive.google.com/uc?export=view&id=1_Kg8wL1aztfoexPJmU9-3T_0uaHAqqoa")
}

function ErrorImageTeam(team_id){
    $("#img_team"+team_id).attr("src", "https://drive.google.com/uc?export=view&id=1ZonLFhchjIk0sosa1k01dTZnym4bDoC1")
}