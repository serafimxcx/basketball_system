$(function(){
    OptionCoaches();
    LoadTeams();

    $("#btn_save").click(function(){
        if($("#txt_imgsource").val()==""){
            alert("Blank Input. Please enter the url id of the image. Type N/A if none.");
            $("#txt_imgsource").focus();
        }else if($("#txt_teamname").val()==""){
            alert("Blank Input. Please enter a team name.");
            $("#txt_teamname").focus();
        }else if($("#slct_coach").val()==""){
            alert("Blank Input. Please select a coach.");
            $("#slct_coach").focus();
        }else{
            if($("#txt_team_id").val()==""){
                AddTeam();
            }else{
                UpdateTeam();
            }
        }
        
     });

     $(document.body).on('click', '.remove-team', function(){
        if ( confirm("Delete this record?") ) 
			RemoveTeam(parseInt($(this).attr("team_id")));
    });

    $(document.body).on("click",".team_records",function() {
		GetTeam(parseInt($(this).attr("team_id")));
	});

    $("#btn_cancel").click(function(){
        Reset();
    });
});

function OptionCoaches(){
    
    $.ajax({
        "type":"POST",
        "url":"option_coach.php",
        "success": function(text){
            $("#slct_coach").html(text);
        }
    });
     
}

function Reset(){
    $("[data_type=txt]").val("");
    $("#txt_course_id").val("");
    $("#slct_coach").val("");

    
}

function ErrorImage(team_id){
    $("#img_team"+team_id).attr("src", "https://drive.google.com/uc?export=view&id=1ZonLFhchjIk0sosa1k01dTZnym4bDoC1")
}

function AddTeam(){
    cParam = "";

    cParam = "txt_imgsource="+$("#txt_imgsource").val();
    cParam += "&txt_teamname="+$("#txt_teamname").val();
    cParam += "&slct_coach="+$("#slct_coach").val();

    $.ajax({
        "type": "POST",
        "url": "add_team.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("New team has been added.")
                Reset();
                LoadTeams();
            }
        }
    });
}

function LoadTeams(){
    $.ajax({
        "type":"POST",
        "url":"load_team.php",
        "success": function(text){
            $("#team_result").html(text);
        }
    });
}

function RemoveTeam(team_id){
    var cParam = "";
	
	cParam = "team_id="+team_id;
	
	$.ajax({
		"type":"POST",
		"url": "remove_team.php",
		"data": cParam,
		"success":function(text) {
			
			if ( text !== "" ) { 
				alert(text); 
			}
			else {
                alert("Team Removed Successfully.")
                Reset();
				LoadTeams();
			}
					
		}
	});
}

function GetTeam(team_id){
    var cParam = "";

    cParam = "team_id="+team_id;

    $.ajax({
        "type":"POST",
        "url": "get_team.php",
        "data": cParam,
        "success": function(text){
            var a_team = JSON.parse(text);

            $("#txt_imgsource").val(a_team.imgsource);
            $("#txt_teamname").val(a_team.teamname);
            $("#slct_coach").val(a_team.optncoach);
            $("#txt_team_id").val(team_id);
        }
    });

}

function UpdateTeam(){
    
    var cParam = "";

    cParam = "txt_imgsource="+$("#txt_imgsource").val();
    cParam += "&txt_teamname="+$("#txt_teamname").val();
    cParam += "&slct_coach="+$("#slct_coach").val();
    cParam += "&team_id="+$("#txt_team_id").val();

    $.ajax({
        "type":"POST",
        "url":"update_team.php",
        "data":cParam,
        "success":function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("Team Updated Successfully.")
                Reset();
                LoadTeams();
            }
        }
    });
        
}
