$(document).ready(function(){

 });

function validateRegister1(){
    debugger;

    $.ajax({
        url:"<?=base_url()?>event/addMember",
        type: "post",
        dataType: 'json',
        data: $('#memberRegistration').serialize(), // provided this code executes in form.onsubmit event
        success: function (output) {
            debugger;
            alert("Member Added");
        },
        failure: function(){
            alert("Member Not Added");
        }
    });

}