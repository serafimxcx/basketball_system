$(function(){
    LoadPositions();

    $("#btn_save").click(function(){
        if($("#txt_position").val()==""){
            alert("Blank Input. Please enter a position.");
            $("#txt_position").focus();
        }else{
            if($("#txt_position_id").val()==""){
                AddPosition();
            }else{
                UpdatePosition();
            }
        }
        
     });

     $(document.body).on('click', '.remove-position', function(){
        if ( confirm("Delete this record?") ) 
			RemovePosition(parseInt($(this).attr("position_id")));
    });

    $(document.body).on("click",".position_records",function() {
		GetPosition(parseInt($(this).attr("position_id")));
	});

    $("#btn_cancel").click(function(){
        Reset();
    });

});

function Reset(){
    $("[data_type=txt]").val("");
    $("#txt_position_id").val(""); 
}

function AddPosition(){
    cParam = "";

    cParam = "txt_position="+$("#txt_position").val();

    $.ajax({
        "type": "POST",
        "url": "add_position.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("New position has been added.")
                Reset();
                LoadPositions();
            }
        }
    });
}

function LoadPositions(){
    $.ajax({
        "type":"POST",
        "url":"load_position.php",
        "success": function(text){
            $("#position_result").html(text);
        }
    });
}

function RemovePosition(position_id){
    var cParam = "";
	
	cParam = "position_id="+position_id;
	
	$.ajax({
		"type":"POST",
		"url": "remove_position.php",
		"data": cParam,
		"success":function(text) {
			
			if ( text !== "" ) { 
				alert(text); 
			}
			else {
                alert("Position Removed Successfully.")
                Reset(); 
				LoadPositions();
			}
					
		}
	});
}

function GetPosition(position_id){
    var cParam = "";

    cParam = "position_id="+position_id;

    $.ajax({
        "type":"POST",
        "url": "get_position.php",
        "data": cParam,
        "success": function(text){
            var a_position = JSON.parse(text);

            $("#txt_position").val(a_position.position);
            $("#txt_position_id").val(position_id);
        }
    });

}

function UpdatePosition(){
    
    var cParam = "";

    cParam = "txt_position="+$("#txt_position").val();
    cParam += "&position_id="+$("#txt_position_id").val();

    $.ajax({
        "type":"POST",
        "url":"update_position.php",
        "data":cParam,
        "success":function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("Position Updated Successfully.")
                Reset();
                LoadPositions();
            }
        }
    });
        
}