var sortSched="";
var homeTeam_id = "";
var awayTeam_id = "";
var gamesched_id = "";

$(function(){
    OptionVenue();
    OptionTeam();
    LoadSchedules(sortSched);


    $("#btn_save").click(function(){

        if($("#txt_date").val()==""){
            alert("Blank Input. Please enter a date.");
            $("#txt_date").focus();
        }else if($("#txt_starttime").val()==""){
            alert("Blank Input. Please enter a start time.");
            $("#txt_starttime").focus();
        }else if($("#txt_endtime").val()==""){
            alert("Blank Input. Please enter an end time.");
            $("#txt_endtime").focus();
        }else if($("#slct_venue").val()==""){
            alert("Blank Input. Please select a venue.");
            $("#slct_venue").focus();
        }else if($("#slct_hometeam").val()==""){
            alert("Blank Input. Please select a home team.");
            $("#slct_hometeam").focus();
        }else if($("#slct_awayteam").val()==""){
            alert("Blank Input. Please select a away team.");
            $("#slct_awayteam").focus();
        }else if($("#slct_hometeam").val()==$("#slct_awayteam").val()){
            alert("Home Team and Away Team must be two different teams.");
            $("#slct_awayteam").focus();
        }else if($('.c_firstfivehome:checked').length == 0){
            alert('Please select the first five for home team.' );
        }else if($('.c_firstfiveaway:checked').length == 0){
            alert('Please select the first five for home team.' );
        }else if($('.c_firstfivehome:checked').length != 5){
            alert('Please select the first five for home team.' );
        }else if($('.c_firstfiveaway:checked').length != 5){
            alert('Please select the first five for home team.' );
        }else{
            if($("#txt_sched_id").val()==""){
                AddSchedule();
                
            }else{
                UpdateSchedule();
                
            }
        }  
     });

    $("#btn_cancel").click(function(){
        Reset();
    });

    $(document.body).on('click', '.remove-sched', function(){
        if ( confirm("Delete this record?") ) 
			RemoveSchedule(parseInt($(this).attr("sched_id")));
    });

    $(document.body).on('click', '.sched_records', function(){
		GetSchedule(parseInt($(this).attr("sched_id")));
	});

    $("#sort_date").change(function(){
		sortSched = $("#sort_date").val();

		LoadSchedules(sortSched);
		
	});

    $("#slct_hometeam").change(function(){
        homeTeam_id = $("#slct_hometeam").val();
        LoadHomeTeam(homeTeam_id, gamesched_id);
          
    });

    $("#slct_awayteam").change(function(){
        awayTeam_id = $("#slct_awayteam").val();
        LoadAwayTeam(awayTeam_id, gamesched_id);
          
    });

    $("#btn_manageteams").click(function(){
        $(".modal").css({"display":"flex"});
    });

    $("#close_modal").click(function(){
        if(confirm("Are you sure you want to close this modal? The data will be reset for teams if you close this modal.")){
            $(".modal").css({"display":"none"});
            $("#btnteams_txt").html("Choose Home Team and Away Team");    
            $("#slct_hometeam").val("");
            $("#slct_awayteam").val("");
            $(".c_firstfivehome").prop('checked', false);
            $(".c_firstfiveaway").prop('checked', false);
            homeTeam_id = "";
            awayTeam_id = "";
            LoadHomeTeam(homeTeam_id, gamesched_id);
            LoadAwayTeam(awayTeam_id, gamesched_id);
        }
        
    
    });

    $("#btn_saveteam").click(function(){
        if($("#slct_hometeam").val()==""){
            alert("Blank Input. Please select a home team.");
            $("#slct_hometeam").focus();
        }else if($("#slct_awayteam").val()==""){
            alert("Blank Input. Please select a away team.");
            $("#slct_awayteam").focus();
        }else if($("#slct_hometeam").val()==$("#slct_awayteam").val()){
            alert("Home Team and Away Team must be two different teams.");
            $("#slct_awayteam").focus();
        }else if($('.c_firstfivehome:checked').length == 0){
            alert('Please select the first five for home team.' );
        }else if($('.c_firstfiveaway:checked').length == 0){
            alert('Please select the first five for home team.' );
        }else if($('.c_firstfivehome:checked').length != 5){
            alert('Please select the first five for home team.' );
        }else if($('.c_firstfiveaway:checked').length != 5){
            alert('Please select the first five for home team.' );
        }else{
            $(".modal").css({"display":"none"});
            $("#btnteams_txt").html("Update Home Team and Away Team");    
            
        }
        
    });

    




  

    
});

function OptionVenue(){
    $.ajax({
        "type":"POST",
        "url":"option_venue.php",
        "success": function(text){
            $("#slct_venue").html(text);
        }
    });
}

function OptionTeam(){
    $.ajax({
        "type":"POST",
        "url":"option_team.php",
        "success": function(text){
            $("#slct_hometeam").html(text);
            $("#slct_awayteam").html(text);
        }
    });
}

function Reset(){
    $("[data_type=txt]").val("");
    $("[data_type=txt]").val("");
    $("#txt_sched_id").val("");
    $("#slct_venue").val("");
    $("#slct_hometeam").val("");
    $("#slct_awayteam").val("");
    $("#btnteams_txt").html("Choose Home Team and Away Team");
    $(".c_firstfivehome").prop('checked', false);
    $(".c_firstfiveaway").prop('checked', false);
    $(".c_isInjuredhome").prop('checked', false);
    $(".c_isInjuredaway").prop('checked', false);
    homeTeam_id = "";
    awayTeam_id = "";
    LoadHomeTeam(homeTeam_id, gamesched_id);
    LoadAwayTeam(awayTeam_id, gamesched_id);
    
    
}

function AddSchedule(){
    cParam = "";

    cParam = "txt_date="+$("#txt_date").val();
    cParam += "&txt_starttime="+$("#txt_starttime").val();
    cParam += "&txt_endtime="+$("#txt_endtime").val();
    cParam += "&slct_venue="+$("#slct_venue").val();
    cParam += "&slct_hometeam="+$("#slct_hometeam").val();
    cParam += "&slct_awayteam="+$("#slct_awayteam").val();
    $.ajax({
        "type": "POST",
        "url": "add_schedule.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("New schedule has been added.")
                LoadSchedules(sortSched);
                saveHomePlayers();
                saveAwayPlayers();

                Reset();
            }
        }
    });
}

function LoadSchedules(sortSched){
    cParam = "";

    cParam = "sortSched=" + sortSched;

    $.ajax({
        "type":"POST",
        "url":"load_schedules.php",
        "data": cParam,
        "success": function(text){
            $("#sched_result").html(text);
        }
    });
}

function RemoveSchedule(sched_id){
    var cParam = "";
	
	cParam = "sched_id="+sched_id;
	
	$.ajax({
		"type":"POST",
		"url": "remove_schedule.php",
		"data": cParam,
		"success":function(text) {
			
			if ( text !== "" ) { 
				alert(text); 
			}
			else {
                alert("Schedule Removed Successfully.")
                Reset();
				LoadSchedules(sortSched);
			}
					
		}
	});
}

function GetSchedule(sched_id){
    var cParam = "";

    cParam = "sched_id="+sched_id;

    $.ajax({
        "type":"POST",
        "url": "get_schedule.php",
        "data": cParam,
        "success": function(text){
            var a_sched = JSON.parse(text);

            $("#txt_date").val(a_sched.date);
            $("#txt_starttime").val(a_sched.starttime);
            $("#txt_endtime").val(a_sched.endtime);
            $("#slct_venue").val(a_sched.venue);
            $("#slct_hometeam").val(a_sched.hometeam);
            $("#slct_awayteam").val(a_sched.awayteam);
            $("#txt_sched_id").val(sched_id);

            $("#btnteams_txt").html("Update Home Team and Away Team");    

            homeTeam_id = $("#slct_hometeam").val();
            awayTeam_id = $("#slct_awayteam").val();
            gamesched_id = $("#txt_sched_id").val();

            LoadHomeTeam(homeTeam_id, gamesched_id);
            LoadAwayTeam(awayTeam_id, gamesched_id);
        }
    });

}

function UpdateSchedule(){
    
    var cParam = "";

    cParam = "txt_date="+$("#txt_date").val();
    cParam += "&txt_starttime="+$("#txt_starttime").val();
    cParam += "&txt_endtime="+$("#txt_endtime").val();
    cParam += "&slct_venue="+$("#slct_venue").val();
    cParam += "&slct_hometeam="+$("#slct_hometeam").val();
    cParam += "&slct_awayteam="+$("#slct_awayteam").val();
    cParam += "&sched_id="+$("#txt_sched_id").val();
    $.ajax({
        "type":"POST",
        "url":"update_schedule.php",
        "data":cParam,
        "success":function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("Schedule Updated Successfully.")
                LoadSchedules(sortSched);

                saveHomePlayers();
                saveAwayPlayers();
                Reset();
            }
        }
    });
        
}

function LoadHomeTeam(homeTeam_id, gamesched_id){
    cParam = "";
    cParam = "homeTeam_id="+homeTeam_id;
    cParam += "&gamesched_id="+gamesched_id;
    $.ajax({
        "type":"POST",
        "url":"loadhomeplayers.php",
        "data":cParam,
        "success":function(text){
            $("#hometeam_result").html(text);
        }
    });
}

function LoadAwayTeam(awayTeam_id){
    cParam = "";
    cParam = "awayTeam_id="+awayTeam_id;
    cParam += "&gamesched_id="+gamesched_id;
    $.ajax({
        "type":"POST",
        "url":"loadawayplayers.php",
        "data":cParam,
        "success":function(text){
            $("#awayteam_result").html(text);
        }
    });

}

function ErrorImageTeam(team_id){
    $("#img_team"+team_id).attr("src", "https://drive.google.com/uc?export=view&id=1ZonLFhchjIk0sosa1k01dTZnym4bDoC1")
}

function saveHomePlayers(){
    var playerStatus = [];

    $(".c_isInjuredhome").each(function() {
      var playerId = $(this).attr("player_id");
      var isInjured = $(this).prop("checked") ? 1 : 0;
      var isFirstFivePlayer = $("#c_firstfivehome" + playerId).prop("checked") ? 1 : 0;
      var selectedPosition = $("#slct_newpositionhome" + playerId).val();
      var home_id = $("#txt_hometeam_id" + playerId).val();

      playerStatus.push({
        playerId: playerId,
        isInjured: isInjured,
        isFirstFive: isFirstFivePlayer,
        selectedPosition: selectedPosition,
        homeTeam: home_id
      });
    });

    console.log(playerStatus);

    var cParam = "hometeam_arr=" + JSON.stringify(playerStatus);

    $.ajax({
        "type":"POST",
        "url":"savegamehomeplayers.php",
        "data":cParam,
        "success":function(text){
            if(text !== ""){
                console.log(text);
            }else{
                console.log("done");
            }
            
        }
    });
}

function saveAwayPlayers(){
    var playerStatus = [];

    $(".c_isInjuredaway").each(function() {
      var playerId = $(this).attr("player_id");
      var isInjured = $(this).prop("checked") ? 1 : 0;
      var isFirstFivePlayer = $("#c_firstfiveaway" + playerId).prop("checked") ? 1 : 0;
      var selectedPosition = $("#slct_newpositionaway" + playerId).val();
      var away_id = $("#txt_awayteam_id" + playerId).val();

      playerStatus.push({
        playerId: playerId,
        isInjured: isInjured,
        isFirstFive: isFirstFivePlayer,
        selectedPosition: selectedPosition,
        awayTeam: away_id
      });
    });

    console.log(playerStatus);

    var cParam = "awayteam_arr=" + JSON.stringify(playerStatus);

    $.ajax({
        "type":"POST",
        "url":"savegameawayplayers.php",
        "data":cParam,
        "success":function(text){
            if(text !== ""){
                console.log(text);
            }else{
                console.log("done");
            }
        }
    });
}


