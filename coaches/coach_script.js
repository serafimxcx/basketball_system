$(function(){
    var contactNumberPattern = /^\d{11}$/;
    LoadCoach();

    $("#btn_save").click(function(){
        if($("#txt_imgsource").val()==""){
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
        }else if($("#txt_contactno").val()==""){
            alert("Blank Input. Please enter a contact number. Type N/A if none.");
            $("#txt_contactno").focus();
        }else if(contactNumberPattern.test($("#txt_contactno").val()) == false){
            alert("This is not a valid contact number. Please enter a 11-digit number ###########");
            $("#txt_contactno").focus();
        }else{
            if($("#txt_coach_id").val()==""){
                console.log("add");
                AddCoach();
            }else{
                UpdateCoach();
            }
        }
        
     });

     $(document.body).on('click', '.remove-coach', function(){
        if ( confirm("Delete this record?") ) 
			RemoveCoach(parseInt($(this).attr("coach_id")));
    });

    $(document.body).on("click",".coach_records",function() {
		GetCoach(parseInt($(this).attr("coach_id")));
	});

    $("#btn_cancel").click(function(){
        Reset();
    });

});

function Reset(){
    $("[data_type=txt]").val("");
    $("#txt_course_id").val("");

    
}

function AddCoach(){
    cParam = "";

    cParam = "txt_imgsource="+$("#txt_imgsource").val();
    cParam += "&txt_lastname="+$("#txt_lastname").val();
    cParam += "&txt_firstname="+$("#txt_firstname").val();
    cParam += "&txt_middlename="+$("#txt_middlename").val();
    cParam += "&txt_contactno="+$("#txt_contactno").val();

    $.ajax({
        "type": "POST",
        "url": "add_coach.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("New coach has been added.")
                Reset();
                LoadCoach();
            }
        }
    });
}

function LoadCoach(){
    $.ajax({
        "type":"POST",
        "url":"load_coach.php",
        "success": function(text){
            $("#coach_result").html(text);
        }
    });
}

function RemoveCoach(coach_id){
    var cParam = "";
	
	cParam = "coach_id="+coach_id;
	
	$.ajax({
		"type":"POST",
		"url": "remove_coach.php",
		"data": cParam,
		"success":function(text) {
			
			if ( text !== "" ) { 
				alert(text); 
			}
			else {
                alert("Coach Removed Successfully.")
                Reset();
				LoadCoach();
			}
					
		}
	});
}

function GetCoach(coach_id){
    var cParam = "";

    cParam = "coach_id="+coach_id;

    $.ajax({
        "type":"POST",
        "url": "get_coach.php",
        "data": cParam,
        "success": function(text){
            var a_coach = JSON.parse(text);

            $("#txt_lastname").val(a_coach.lastname);
            $("#txt_firstname").val(a_coach.firstname);
            $("#txt_middlename").val(a_coach.middlename);
            $("#txt_imgsource").val(a_coach.imgsource);
            $("#txt_contactno").val(a_coach.contactno);
            $("#txt_coach_id").val(coach_id);
        }
    });

}

function UpdateCoach(){
    
    var cParam = "";

    cParam = "txt_imgsource="+$("#txt_imgsource").val();
    cParam += "&txt_lastname="+$("#txt_lastname").val();
    cParam += "&txt_firstname="+$("#txt_firstname").val();
    cParam += "&txt_middlename="+$("#txt_middlename").val();
    cParam += "&txt_contactno="+$("#txt_contactno").val();
    cParam += "&coach_id="+$("#txt_coach_id").val();

    $.ajax({
        "type":"POST",
        "url":"update_coach.php",
        "data":cParam,
        "success":function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("Coach Updated Successfully.")
                Reset();
                LoadCoach();
            }
        }
    });
        
}

function ErrorImage(coach_id){
    $("#img_coach"+coach_id).attr("src", "https://drive.google.com/uc?export=view&id=1_Kg8wL1aztfoexPJmU9-3T_0uaHAqqoa")
}

