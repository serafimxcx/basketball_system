var sort="";
var team="";

$(function(){
    LoadPlayerStats(sort, team);
    OptionTeam();

    $("#print_allplayerstats").click(function() {
		var cFile = "print_allplayerstats.php?sort="+sort+"&team_id="+team;
		window.open(cFile, "_blank");
	});

    $("#slct_team").change(function(){
        team = $("#slct_team").val();
        LoadPlayerStats(sort, team);
    });

    $(document.body).on('click', '.sort_rank', function() {
        if(sort != "rank ASC"){
            sort = "rank ASC";
        }else if (sort=="rank ASC"){
            sort = "rank DESC";
        }else if (sort=="rank DESC"){
            sort = "rank ASC";
        }
		
        console.log(sort);
        LoadPlayerStats(sort, team);
	});

    $(document.body).on('click', '.sort_team', function() {
        if(sort != "team_name ASC"){
            sort = "team_name ASC";
        }else if (sort=="team_name ASC"){
            sort = "team_name DESC";
        }else if (sort=="team_name DESC"){
            sort = "team_name ASC";
        }
		
        console.log(sort);
        LoadPlayerStats(sort, team);
        
	});

    $(document.body).on('click', '.sort_name', function() {
        if(sort != "playername ASC"){
            sort = "playername ASC";
        }else if (sort=="playername ASC"){
            sort = "playername DESC";
        }else if (sort=="playername DESC"){
            sort = "playername ASC";
        }
		
        console.log(sort);
        LoadPlayerStats(sort, team);
        
	});
});

function LoadPlayerStats(sort, team){
    var cParam = "sort="+sort;

    cParam += "&team_id="+team;

    console.log(cParam);
    $.ajax({
        "type":"POST",
        "url":"load_allplayerstats.php",
        "data": cParam,
        "success": function(text){
            $("#allplayerstats_result").html(text);
        }
    });
}

function ErrorImage(player_id){
    $("#img_player"+player_id).attr("src", "https://drive.google.com/uc?export=view&id=1_Kg8wL1aztfoexPJmU9-3T_0uaHAqqoa")
}

function OptionTeam(){
    $.ajax({
        "type":"POST",
        "url":"../schedule/option_team.php",
        "success": function(text){
            $("#slct_team").html(text);
        }
    });
}