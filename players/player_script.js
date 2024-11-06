var sortPlayer = "";

$(function(){
    OptionTeams();
    OptionPositions();
    LoadPlayers(sortPlayer);

    $("#btn_save").click(function(){

        if($("#slct_team").val()==""){
            alert("Blank Input. Please select a team.");
            $("#slct_team").focus();
        }else if($("#slct_position").val()==""){
            alert("Blank Input. Please select a position.");
            $("#slct_position").focus();
        }else if($("#txt_playernum").val()==""){
            alert("Blank Input. Please enter a player number.");
            $("#txt_playernum").focus();
        }else if($("#txt_playernum").val() > 99){
            alert("Huge number. Only choose a number between 1-99.");
            $("#txt_playernum").focus();
        }else if($("#txt_imgsource").val()==""){
            alert("Blank Input. Please enter the url id of the image. Type N/A if none.");
            $("#txt_imgsource").focus();
        }else if($("#txt_lastname").val()==""){
            alert("Blank Input. Please enter a last name.");
            $("#txt_lastname").focus();
        }else if($("#txt_firstname").val()==""){
            alert("Blank Input. Please enter a first name.");
            $("#txt_firstname").focus();
        }else if($("#txt_middlename").val()==""){
            alert("Blank Input. Please enter a middle name. Type N/A if none.");
            $("#txt_middlename").focus();
        }else if($("#txt_height").val()==""){
            alert("Blank Input. Please enter a height.");
            $("#txt_height").focus();
        }else if($("#txt_weight").val()==""){
            alert("Blank Input. Please enter a weight.");
            $("#txt_weight").focus();
        }else{
            if($("#txt_player_id").val()==""){
                AddPlayer();
            }else{
                UpdatePlayer();
            }
        }  
     });

     $(document.body).on('click', '.remove-player', function(){
        if ( confirm("Delete this record?") ) 
			RemovePlayer(parseInt($(this).attr("player_id")));
    });

    $(document.body).on("click",".player_records",function() {
		GetPlayer(parseInt($(this).attr("player_id")));
	});

    $("#btn_cancel").click(function(){
        Reset();
    });

    $("#sort_player").change(function(){
		sortPlayer = $("#sort_player").val();
        console.log(sortPlayer);

		LoadPlayers(sortPlayer);
		
	});

    
});

function OptionTeams(){
    
    $.ajax({
        "type":"POST",
        "url":"option_team.php",
        "success": function(text){
            $("#slct_team").html(text);
            $("#sort_player").html(text);
        }
    });
     
}

function OptionPositions(){
    
    $.ajax({
        "type":"POST",
        "url":"option_position.php",
        "success": function(text){
            $("#slct_position").html(text);
        }
    });
     
}

function Reset(){
    $("[data_type=txt]").val("");
    $("#txt_player_id").val("");
    $("#slct_team").val("");
    $("#slct_position").val("");

    
}

function AddPlayer(){
    cParam = "";

    cParam = "txt_imgsource="+$("#txt_imgsource").val();
    cParam += "&slct_team="+$("#slct_team").val();
    cParam += "&slct_position="+$("#slct_position").val();
    cParam += "&txt_lastname="+$("#txt_lastname").val();
    cParam += "&txt_firstname="+$("#txt_firstname").val();
    cParam += "&txt_middlename="+$("#txt_middlename").val();
    cParam += "&txt_height="+$("#txt_height").val();
    cParam += "&txt_weight="+$("#txt_weight").val();
    cParam += "&txt_birthdate="+$("#txt_birthdate").val();
    cParam += "&txt_playernum="+$("#txt_playernum").val();

    $.ajax({
        "type": "POST",
        "url": "add_player.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("New player has been added.")
                Reset();
                LoadPlayers(sortPlayer);
            }
        }
    });
}

function LoadPlayers(sortPlayer){
    var cParam = "";

    cParam = "sortPlayer="+ sortPlayer;

    $.ajax({
        "type":"POST",
        "url":"load_players.php",
        "data": cParam,
        "success": function(text){
            $("#player_result").html(text);
        }
    });
}

function ErrorImage(player_id){
    $("#img_player"+player_id).attr("src", "https://drive.google.com/uc?export=view&id=1_Kg8wL1aztfoexPJmU9-3T_0uaHAqqoa")
}

function RemovePlayer(player_id){
    var cParam = "";
	
	cParam = "player_id="+player_id;
	
	$.ajax({
		"type":"POST",
		"url": "remove_player.php",
		"data": cParam,
		"success":function(text) {
			
			if ( text !== "" ) { 
				alert(text); 
			}
			else {
                alert("Player Removed Successfully.")
                Reset();
				LoadPlayers(sortPlayer);
			}
					
		}
	});
}

function GetPlayer(player_id){
    var cParam = "";

    cParam = "player_id="+player_id;

    $.ajax({
        "type":"POST",
        "url": "get_player.php",
        "data": cParam,
        "success": function(text){
            var a_player = JSON.parse(text);

            $("#txt_lastname").val(a_player.lastname);
            $("#txt_firstname").val(a_player.firstname);
            $("#txt_middlename").val(a_player.middlename);
            $("#txt_imgsource").val(a_player.imgsource);
            $("#txt_height").val(a_player.height);
            $("#txt_weight").val(a_player.weight);
            $("#slct_team").val(a_player.team);
            $("#slct_position").val(a_player.position);
            $("#txt_birthdate").val(a_player.birthdate);
            $("#txt_playernum").val(a_player.playernum);
            $("#txt_player_id").val(player_id);
        }
    });

}

function UpdatePlayer(){
    
    var cParam = "";

    cParam = "txt_imgsource="+$("#txt_imgsource").val();
    cParam += "&slct_team="+$("#slct_team").val();
    cParam += "&slct_position="+$("#slct_position").val();
    cParam += "&txt_lastname="+$("#txt_lastname").val();
    cParam += "&txt_firstname="+$("#txt_firstname").val();
    cParam += "&txt_middlename="+$("#txt_middlename").val();
    cParam += "&txt_height="+$("#txt_height").val();
    cParam += "&txt_weight="+$("#txt_weight").val();
    cParam += "&txt_birthdate="+$("#txt_birthdate").val();
    cParam += "&player_id="+$("#txt_player_id").val();
    cParam += "&txt_playernum="+$("#txt_playernum").val();

    $.ajax({
        "type":"POST",
        "url":"update_player.php",
        "data":cParam,
        "success":function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("Player Updated Successfully.")
                Reset();
                LoadPlayers(sortPlayer);
            }
        }
    });
        
}
