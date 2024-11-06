$(function(){

    $("#btn_cancel").click(function(){  
        if(confirm("Are you sure to cancel?")){
            window.location.href="/basketball_system/dashboard.php";
        }
    });

    $("#btn_changepass").click(function(){  
        if($("#txt_currentpass").val() == ""){
            alert("Blank Input.");
            $("#txt_currentpass").focus();
        }else if($("#txt_newpass").val() == ""){
            alert("Blank Input.");
            $("#txt_newpass").focus();
        }else if($("#txt_newpass2").val() == ""){
            alert("Blank Input.");
            $("#txt_newpass2").focus();
        }else if($("#txt_newpass2").val() != $("#txt_newpass").val()){
            alert("New Password does not match.");
            $("#txt_newpass2").focus();
        }else{
            UpdatePassword();
        }

       
    });

});

function UpdatePassword(){
    cParam = "";

    cParam = "txt_currentpass="+$("#txt_currentpass").val();
    cParam += "&txt_newpass="+$("#txt_newpass").val();

    $.ajax({
        "type":"POST",
        "url": "updatepassword.php",
        "data": cParam,
        "success": function(text){
            if(text == "success"){
                alert("Password Updated Successfully");
                if(confirm("Do you want to stay login?")){
                    window.location.href="/basketball_system/dashboard.php";
                }else{
                    alert("You have logged out your account.")
                    window.location.href="/basketball_system/logout.php";
                }
                
            }else{
                alert("Password Updated Unsuccessfully. Current password does not match.");
                $("#txt_currentpass").val("");
                $("#txt_newpass").val("");
                $("#txt_newpass2").val("");
            }
           
        }
    });

}