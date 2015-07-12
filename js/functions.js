/**
 * Created by Hudhaifa Yoosuf on 6/21/15.
 */

//

function showalert(message, alerttype, id, type) {
    $("<div class='new_"+ alerttype +"' >"+ message +"</div>").appendTo('body');
    if (type == "modal") $('#' + id).modal('toggle');
  //  $('#alert').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><span>' + message + '</span></div>')

    setTimeout(function () { // this will automatically close the alert and remove this if the users doesnt close it in 5 secs
        if (type == "modal") {
            location.reload();
        }
        else if(type=="redirect"){
            window.location.href = id;
        }
        $(".new_"+alerttype).remove();
    }, 3000);
}

function getOnlyCurrentDate() {
    var d = new Date();

    var month = d.getMonth() + 1;
    var day = d.getDate();

    var output = d.getFullYear() + '-' +
        (month < 10 ? '0' : '') + month + '-' +
        (day < 10 ? '0' : '') + day;

    return output;
}

function saveBasicEvent(formName) {
    debugger;
    var Message = "";
    if (formName == "birthdayForm") {
        $(".ClickedDate").val($("#Byear").val() + "-" + $("#Bmonth").val() + "-" + $("#Bdate").val());
        Message = "Birthday Has Been Added Successfully.";
    }
    else if (formName == "eventForm") {
        Message = "Event Has Been Added Successfully."
    }

    $.ajax({
        url: "process/index.php?route=event&method=insertBasicEvent",//event.php
        type: "post",
        dataType: 'json',
        data: $('#' + formName).serialize(), // provided this code executes in form.onsubmit event
        success: function (output) {
            debugger;
            $('#' + formName)[0].reset();
            if (output.success > 0) {

                showalert(Message, "alert-success", "CommonModal", "modal");
            }
            else {
                showalert("An Error Occurred Please Contact Admin.", "alert-danger", "", "");
            }
        },
        failure: function () {
            showalert("An Error Occurred Please Contact Admin.", "alert-danger", "", "");
        }
    });
}


function setSessionsForAdvanceNote(date) {
    localStorage.setItem("advanceID", "0");
    localStorage.setItem("tempSubject", $("#Subject").val());
    localStorage.setItem("tempDescription", $("#description").val());
    localStorage.setItem("tempClickedDate", date);
    window.location.href = "/Online-Calender/ConfigureEvents.html";

}

function editAdvanceNote(id) {
    localStorage.setItem("advanceID", id);
    window.location.href = "/Online-Calender/ConfigureEvents.html";

}

function validateLogin(formName) {
    debugger;

    $.ajax({
        url: "process/index.php?route=event&method=validateLogin",//event.php
        type: "post",
        dataType: 'json',
        data: $('#' + formName).serialize(), // provided this code executes in form.onsubmit event
        success: function (output) {
            debugger;
            //$('#'+formName)[0].reset();
            if (output.success > 0) {
                localStorage.setItem("memberId", output.success);
                window.location.href = "/Online-Calender/Calendar.html";
            }
            else {
                showalert("An Error Occurred Please Contact Admin.", "alert-danger", "", "");
            }
        },
        failure: function () {
            showalert("An Error Occurred Please Contact Admin.", "alert-danger", "", "");
        }
    });
}

function createNewSignUp(formName)
{   debugger;
    var Message="";
    Message ="You Have Been Successfully Registered.";

    $.ajax({
            url: "process/index.php?route=event&method=createNewSignUp",//event.php
            type: "post",
            dataType: 'json',
            data: $('#'+formName).serialize(), // provided this code executes in form.onsubmit event
            success: function (output) {
                debugger;
                $('#'+formName)[0].reset();
                if(output.success > 0)
                {
                    showalert(Message,"alert-success","/Online-Calender/Calendar.html","redirect");
                }
                else{
                    showalert("An Error Occurred Please Contact Admin.","alert-danger","","");
                }
            },
            failure: function(){
                showalert("An Error Occurred Please Contact Admin.","alert-danger","","");
            }
        });
}

function editBasicEvent(formName,id) {
    debugger;
    var Message = "";
    if (formName == "birthdayForm") {
        $(".ClickedDate").val($("#Byear").val() + "-" + $("#Bmonth").val() + "-" + $("#Bdate").val());
        Message = "Birthday Has Been Updated Successfully.";
    }
    else if (formName == "eventForm") {
        Message = "Event Has Been Updated Successfully."
    }

    $.ajax({
        url: "process/index.php?route=event&method=editBasicEvent",//event.php
        type: "post",
        dataType: 'json',
        data: $('#' + formName).serialize()+"&id="+id, // provided this code executes in form.onsubmit event
        success: function (output) {
            debugger;
            $('#' + formName)[0].reset();
            if (output.success > 0) {
                showalert(Message, "alert-success", "CommonModal", "modal");
            }
            else {
                showalert("An Error Occurred Please Contact Admin.", "alert-danger", "", "");
            }
        },
        failure: function () {
            showalert("An Error Occurred Please Contact Admin.", "alert-danger", "", "");
        }
    });
}

    function deleteBasicEvent(formName,id){
        debugger;
        var Message = "";
        if (formName == "birthdayForm") {
            Message = "Birthday Has Been Deleted Successfully.";
        }
        else if (formName == "eventForm") {
            Message = "Event Has Been Deleted Successfully."
        }

        $.ajax({
            url: "process/index.php?route=event&method=deleteBasicEvent",//event.php
            type: "post",
            dataType: 'json',
            data: $('#' + formName).serialize()+"&id="+id, // provided this code executes in form.onsubmit event
            success: function (output) {
                debugger;
                $('#' + formName)[0].reset();
                if (output.success == "Deleted") {
                    showalert(Message, "alert-success", "CommonModal", "modal");
                }
                else {
                    showalert("An Error Occurred Please Contact Admin.", "alert-danger", "", "");
                }
            },
            failure: function () {
                showalert("An Error Occurred Please Contact Admin.", "alert-danger", "", "");
            }
        });
    }

getNotification();
function getNotification(){
    getData();
    setInterval(function(){
        getData();
    },60000);

    function getData(){
        $.ajax({
            url : "process/?route=event&method=getCurrentEvent",
            type: "post",
            data : { date : dateFormat(new Date()) },
            dataType: "json",
            success :function(e){
                if(e.length > 0 ){
                    $.each(e,function(k,v){
                        item = $('<a class="lv-item" href=""><div class="media">' +
                            '<div class="pull-left">' +
                            ' <img class="lv-img-sm" src="img/profile-pics/1.jpg" alt="">' +
                            ' </div>' +
                            ' <div class="media-body">' +
                            '<div class="lv-title">'+ v.name +'</div>' +
                            '<small class="lv-small">'+ v.description +'</small>' +
                            ' </div>' +
                            ' </div>' +
                            '</a>');
                        $('#notifications').find('.lv-body').append(item);
                    });
                    $('.tm-notification').html( '<i class="tmn-counts" >'+e.length+'</i>');
                }
            }
        });
    }
}