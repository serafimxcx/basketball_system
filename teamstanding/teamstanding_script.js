var sort = "";

$(function(){
    LoadStanding(sort);

    $("#print_teamstanding").click(function() {
		var cFile = "print_standings.php?sort="+sort;
		window.open(cFile, "_blank");
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
        LoadStanding(sort);
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
        LoadStanding(sort);
	});
});

function LoadStanding(sort){
    var cParam = "sort="+sort;

    $.ajax({
        "type":"POST",
        "url":"load_standings.php",
        "data":cParam,
        "success": function(text){
            $("#teamstanding_result").html(text);
        }
    });
}

function ErrorImage(team_id){
    $("#img_team"+team_id).attr("src", "https://drive.google.com/uc?export=view&id=1ZonLFhchjIk0sosa1k01dTZnym4bDoC1")
}



