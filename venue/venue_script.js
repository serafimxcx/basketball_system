$(function(){
    LoadVenues();

    $("#btn_save").click(function(){
        if($("#txt_venue").val()==""){
            alert("Blank Input. Please enter a venue.");
            $("#txt_venue").focus();
        }else{
            if($("#txt_venue_id").val()==""){
                AddVenue();
            }else{
                UpdateVenue();
            }
        }
        
     });

     $(document.body).on('click', '.remove-venue', function(){
        if ( confirm("Delete this record?") ) 
			RemoveVenue(parseInt($(this).attr("venue_id")));
    });

    $(document.body).on("click",".venue_records",function() {
		GetVenue(parseInt($(this).attr("venue_id")));
	});

    $("#btn_cancel").click(function(){
        Reset();
    });
});

function Reset(){
    $("[data_type=txt]").val("");
    $("#txt_venue_id").val(""); 
}

function AddVenue(){
    cParam = "";

    cParam = "txt_venue="+$("#txt_venue").val();

    $.ajax({
        "type": "POST",
        "url": "add_venue.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("New venue has been added.")
                Reset();
                LoadVenues();
            }
        }
    });
}

function LoadVenues(){
    $.ajax({
        "type":"POST",
        "url":"load_venue.php",
        "success": function(text){
            $("#venue_result").html(text);
        }
    });
}

function RemoveVenue(venue_id){
    var cParam = "";
	
	cParam = "venue_id="+venue_id;
	
	$.ajax({
		"type":"POST",
		"url": "remove_venue.php",
		"data": cParam,
		"success":function(text) {
			
			if ( text !== "" ) { 
				alert(text); 
			}
			else {
                alert("Venue Removed Successfully.")
                Reset(); 
				LoadVenues();
			}
					
		}
	});
}

function GetVenue(venue_id){
    var cParam = "";

    cParam = "venue_id="+venue_id;

    $.ajax({
        "type":"POST",
        "url": "get_venue.php",
        "data": cParam,
        "success": function(text){
            var a_venue = JSON.parse(text);

            $("#txt_venue").val(a_venue.venue);
            $("#txt_venue_id").val(venue_id);
        }
    });

}

function UpdateVenue(){
    
    var cParam = "";

    cParam = "txt_venue="+$("#txt_venue").val();
    cParam += "&venue_id="+$("#txt_venue_id").val();

    $.ajax({
        "type":"POST",
        "url":"update_venue.php",
        "data":cParam,
        "success":function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("Venue Updated Successfully.")
                Reset();
                LoadVenues();
            }
        }
    });
        
}