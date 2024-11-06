var gameSchedID="";

$(function(){
    OptionSchedule();

    LoadStats(gameSchedID);

    


    $("#slct_gamesched").change(function(){
		gameSchedID = $("#slct_gamesched").val();
        $("#transaction_container").css({"display":"block"});
        var selected = $(this).find('option:selected');
        console.log(selected.attr("sched_info"));
        $("#sched_game").html(selected.attr("sched_info"));
        $("#txt_hometeam_id").val(selected.attr("hometeam_id"));
        $("#txt_awayteam_id").val(selected.attr("awayteam_id"));

        LoadStats(gameSchedID);
		
	});

    //live search tag event
    $("#search_player").keyup(function () {
        var cParam = "query="+$(this).val();
        cParam += "&gamesched_id="+gameSchedID;

        if ($(this).val() != "") {
            $.ajax({
                "type": 'POST',
                "url": 'searchplayers.php',      
                "data": cParam,
                "success": function (text) {
                    $('#searchplayer_result').html(text);
                    $('#searchplayer_result').css('display', 'block');
                    $('#searchplayer_div').css('background-color', 'white');
                    $('#searchplayer_div').css('box-shadow', '0px 8px 16px 0px rgba(0,0,0,0.2)');
                

                   
                }
            });
        } else {
            $('#searchplayer_result').css('display', 'none');
            $('#searchplayer_div').css('box-shadow', 'none');
            $("#txt_player_id").val('');
            $("#txt_playerteam_id").val('');
        }
    });

    $(document).on('click', '.player_result', function(){
        $("#txt_player_id").val($(this).attr("player_id"));
        $("#txt_playerteam_id").val($(this).attr("playerteam_id"));
        $("#search_player").val($(this).attr("player_info"));
        $('#searchplayer_result').css('display', 'none');
        $('#searchplayer_div').css('box-shadow', 'none');
    });



    $("#btn_save").click(function(){
        if($("#search_player").val()==""){
            alert("Blank Input. Select a player.");
            $("#search_player").focus();
        }else if($("#slct_action").val()==""){
            alert("Blank Input. Select an action.");
            $("#slct_action").focus();
        }else{
            if($("#txt_stats_id").val()==""){
                AddStats();
                
            }else{
                UpdateStats();
                
            }
        }
        
        
    });

    $("#btn_cancel").click(function(){
        Reset();
    });

    $(document.body).on('click', '.remove-stats', function(){
        if ( confirm("Delete this record?") ) 
			RemoveStats(parseInt($(this).attr("gamestats_id")), gameSchedID);
    });

    $(document.body).on('click', '.stats_records', function(){
		GetStats(parseInt($(this).attr("gamestats_id")));
    });

    $("#btn_finishgame").click(function(){
        if(confirm("Are you sure you want to conclude the game?")){
            if($("#txt_hometotalscore").text() == "0" && $("#txt_awaytotalscore").text() == "0"){
                alert("You can't finish the game if both teams have no scores.");
            }else{
                FinishGame();
            }
            
        }
    });

    $("#btn_editgame").click(function(){
        if(confirm("Do you want to edit the game?")){
            EditGame();
        }
    });

});

function OptionSchedule(){
    $.ajax({
        "type":"POST",
        "url":"option_sched.php",
        "success": function(text){
            $("#slct_gamesched").html(text);
        }
    });
}

function Reset(){
    $("#search_player").val("");
    $("#txt_player_id").val("");
    $("#txt_playerteam_id").val("");
    $("#txt_stats_id").val("");
    $("#slct_action").val("");
    $("#slct_quarter").prop('disabled', false);
}


// function LoadHomeTeam(gameSchedID){
//     var cParam = "";

//     cParam = "sched_id="+ gameSchedID;

//     $.ajax({
//         "type":"POST",
//         "url":"load_stathome.php",
//         "data": cParam,
//         "success": function(text){
//             $("#homestats_result").html(text);
//         }
//     });
// }

// function LoadAwayTeam(gameSchedID){
//     var cParam = "";

//     cParam = "sched_id="+ gameSchedID;

//     $.ajax({
//         "type":"POST",
//         "url":"load_stataway.php",
//         "data": cParam,
//         "success": function(text){
//             $("#awaystats_result").html(text);
//         }
//     });
// }


function ErrorImagePlayer(player_id){
    $("#img_player"+player_id).attr("src", "https://drive.google.com/uc?export=view&id=1_Kg8wL1aztfoexPJmU9-3T_0uaHAqqoa")
}

function ErrorImageTeam(team_id){
    $("#img_team"+team_id).attr("src", "https://drive.google.com/uc?export=view&id=1ZonLFhchjIk0sosa1k01dTZnym4bDoC1")
}


function AddStats(){
    var cParam = "";
    cParam = "gamesched_id="+$("#slct_gamesched").val();
    cParam += "&quarter="+$("#slct_quarter").val();
    cParam += "&player_id="+$("#txt_player_id").val();
    cParam += "&playerteam_id="+$("#txt_playerteam_id").val();
    cParam += "&action="+$("#slct_action").val();

    $.ajax({
        "type":"POST",
        "url": "add_stats.php",
        "data":cParam,
        "success": function(text){
            if(text !== ""){
                alert(text)
            }else{
                alert("Successfully Added.");
                LoadStats($("#slct_gamesched").val());
                Reset();
            }

        }
    });
}

function LoadStats(gamesched_id){
    var cParam = "";

    cParam = "gamesched_id="+ gamesched_id;

    $.ajax({
        "type": "POST",
        "url": "load_stats.php",
        "data": cParam,
        "success": function(text){
            $("#stats_result").html(text);

            if($("#txt_isLocked").val() == 1){
                $("#search_player").prop('disabled', true);
                $("#slct_quarter").prop('disabled', true);
                $("#check_lockquarter").prop('disabled', true);
                $("#slct_action").prop('disabled', true);
                $("#btn_save").prop('disabled', true);
                $("#btn_finishgame").prop('disabled', true);
                $(".remove_item").prop('disabled', true);
                $(".remove_item").css({"opacity":"0.5"});
                $(".remove_item").css({"cursor":"not-allowed"});
                $("#btn_editgame").css({"display":"inline-block"});
                $("#btn_finishgame").text("Game Concluded");
            }else{
                $("#search_player").prop('disabled', false);
                $("#slct_quarter").prop('disabled', false);
                $("#check_lockquarter").prop('disabled', false);
                $("#slct_action").prop('disabled', false);
                $("#btn_save").prop('disabled', false);
                $("#btn_finishgame").prop('disabled', false);
                $(".remove_item").prop('disabled', false);
                $(".remove_item").css({"opacity":"1"});
                $(".remove_item").css({"cursor":"pointer"});
                $("#btn_editgame").css({"display":"none"});
                $("#btn_finishgame").text("Conclude the Game");
            }
        }
    });
}

function RemoveStats(gamestats_id, gamesched_id){
    var cParam = "";
	
	cParam = "gamestats_id="+gamestats_id;
	
	$.ajax({
		"type":"POST",
		"url": "remove_stats.php",
		"data": cParam,
		"success":function(text) {
			
			if ( text !== "" ) { 
				alert(text); 
			}
			else {
                Reset();
				LoadStats(gamesched_id);
			}
					
		}
	});
}

function GetStats(gamestats_id){
    var cParam = "";
    cParam = "gamestats_id="+gamestats_id;

    $.ajax({
        "type":"POST",
        "url":"get_stats.php",
        "data": cParam,
        "success": function(text){
            var a_stats = JSON.parse(text);

            $("#txt_player_id").val(a_stats.player_id);
            $("#txt_playerteam_id").val(a_stats.playerteam_id);
            getPlayer(a_stats.player_id);
            $("#slct_action").val(a_stats.action);
            $("#slct_quarter").val(a_stats.quarter);
            $("#txt_stats_id").val(gamestats_id);
        }
    });
}

function getPlayer(player_id){
    var cParam = "player_id="+player_id;

    $.ajax({
        "type": 'POST',
        "url": 'getplayer.php',      
        "data": cParam,
        "success": function (text) {
            console.log(text);
            $('#search_player').val(text);   
        }
    });
       
}

function UpdateStats(){
    var cParam = "";
    cParam = "gamesched_id="+$("#slct_gamesched").val();
    cParam += "&quarter="+$("#slct_quarter").val();
    cParam += "&player_id="+$("#txt_player_id").val();
    cParam += "&playerteam_id="+$("#txt_playerteam_id").val();
    cParam += "&action="+$("#slct_action").val();
    cParam += "&gamestats_id="+$("#txt_stats_id").val();

    $.ajax({
        "type":"POST",
        "url": "update_stats.php",
        "data":cParam,
        "success": function(text){
            if(text !== ""){
                alert(text)
            }else{
                alert("Successfully Updated.");
                LoadStats($("#slct_gamesched").val());
                Reset();
            }

        }
    });
}

function FinishGame(){
    var cParam = "";

    cParam = "gamesched_id="+$("#slct_gamesched").val();
    cParam += "&hometeam_id="+$("#txt_hometeam_id").val();
    cParam += "&awayteam_id="+$("#txt_awayteam_id").val();
    cParam += "&home_total_score="+parseInt($("#txt_hometotalscore").text());
    cParam += "&away_total_score="+parseInt($("#txt_awaytotalscore").text());

   $.ajax({
        "type":"POST",
        "url":"finishgame.php",
        "data":cParam,
        "success":function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("Game Finished.");
                LoadStats($("#slct_gamesched").val());
            }
        }
   });
}

function EditGame(){
    var cParam = "";

    cParam = "gamesched_id="+$("#slct_gamesched").val();

    $.ajax({
        "type":"POST",
        "url":"editgame.php",
        "data":cParam,
        "success":function(text){
            if(text !== ""){
                alert(text);
            }else{
                console.log("done");
                LoadStats($("#slct_gamesched").val());
            }
        }
    });
}

  
  