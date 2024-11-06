$(function(){
    LoadUsers();

    $("#btn_save").click(function(){
        if($("#txt_name").val()==""){
            alert("Blank Input. Please enter a name for the user.");
            $("#txt_name").focus();
        }else if($("#txt_username").val()==""){
            alert("Blank Input. Please enter a username for the user.");
            $("#txt_username").focus();
        } else if($("#txt_password").val()==""){
            alert("Blank Input. Please enter a password for the user.");
            $("#txt_password").focus();
        } else{
            if($("#txt_user_id").val()==""){
                AddUser();
            }else{
                UpdateUser();
            }

        }
    });

    $(document.body).on('click', '.remove-user', function(){
        if ( confirm("Delete this record?") ) 
			RemoveUser(parseInt($(this).attr("user_id")));
    });

    $(document.body).on("click",".user_records",function() {
		GetUser(parseInt($(this).attr("user_id")));
	});

    $("#btn_cancel").click(function(){
        Reset();
    });
});

function Reset(){
    $("[data_type=txt]").val("");
    $("#txt_user_id").val("");    
}

function AddUser(){
    var cParam="";

    cParam = "txt_name="+$("#txt_name").val();
    cParam += "&txt_username="+$("#txt_username").val();
    cParam += "&txt_password="+$("#txt_password").val();

    $.ajax({
        "type":"POST",
        "url":"add_user.php",
        "data":cParam,
        "success": function(text){
            if(text != ""){
                alert(text);
                $("#txt_username").focus();
            }else{
                alert("New user has been successfully added.");
                LoadUsers();
                Reset();
            }
        }
    });
}

function LoadUsers(){
    $.ajax({
        "type":"POST",
        "url":"load_users.php",
        "success":function(text){
            $("#users_result").html(text);
        }
    });
}

function RemoveUser(user_id){
    var cParam = "";
	
	cParam = "user_id="+user_id;
	
	$.ajax({
		"type":"POST",
		"url": "remove_user.php",
		"data": cParam,
		"success":function(text) {
			
			if ( text !== "" ) { 
				alert(text); 
			}
			else {
                Reset();
				LoadUsers();
			}
					
		}
	});
}

function GetUser(user_id){
    var cParam = "";

    cParam = "user_id="+user_id;

    $.ajax({
        "type":"POST",
        "url": "get_user.php",
        "data": cParam,
        "success": function(text){
            var a_user = JSON.parse(text);

            $("#txt_name").val(a_user.name);
            $("#txt_username").val(a_user.username);
            $("#txt_password").val(a_user.password);
            $("#txt_user_id").val(user_id);
        }
    });

}

function UpdateUser(){
    
    var cParam = "";

    cParam = "txt_name="+$("#txt_name").val();
    cParam += "&txt_username="+$("#txt_username").val();
    cParam += "&txt_password="+$("#txt_password").val();
    cParam += "&user_id="+$("#txt_user_id").val();

    $.ajax({
        "type":"POST",
        "url":"update_user.php",
        "data":cParam,
        "success":function(text){
            if(text !== ""){
                alert(text);
            }else{
                alert("User Updated Successfully.")
                Reset();
                LoadUsers();
            }
        }
    });
        
}
