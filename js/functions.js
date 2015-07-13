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

    function dateFormat(d, format) {
    var h = "";
    switch (format) {
        case "YYYY-m-d":
            return d.getFullYear() + "-" + (d.getMonth() + 1 > 10 ? "" : "0") + (d.getMonth() + 1) + "-" + (d.getDate() > 10 ? "" : "0") + d.getDate();
            break;
        case "m-d":
            return (d.getMonth() + 1 > 10 ? "" : "0") + (d.getMonth() + 1) + "-" + (d.getDate() > 10 ? "" : "0") + d.getDate();
            break;
        case "y":
            return d.getFullYear() ;
            break;
        case "m":
            return (d.getMonth() + 1 > 10 ? "" : "0") + (d.getMonth() + 1) ;
            break;
        case "d":
            return  (d.getDate() > 10 ? "" : "0") + d.getDate();
            break;
        case "D" :
            return title_name.daysMin[d.getDay()];
            break;
        default :
            return d.getFullYear() + "-" + (d.getMonth() + 1 > 10 ? "" : "0") + (d.getMonth() + 1) + "-" + (d.getDate() > 10 ? "" : "0") + d.getDate();
            break;
    }

}

    function setSessionsForAdvanceNote(date) {
    localStorage.setItem("advanceID", "0");
    localStorage.setItem("tempSubject", $("#Subject").val());
    localStorage.setItem("tempDescription", $("#description").val());
    localStorage.setItem("tempClickedDate", date);
    window.location.href = "/Online-Calender/ConfigureEvents.html";
}

    function clearSessionsForAdvanceNote() {
    localStorage.setItem("advanceID", "0");
    localStorage.setItem("tempSubject", "0");
    localStorage.setItem("tempDescription", "0");
    localStorage.setItem("tempClickedDate", "0");
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

    function createNewSignUp(formName){
    debugger;
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
    else if (formName == "meetingForm") {
        Message = "Meeting Has Been Added Successfully."
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
    else if (formName == "meetingForm") {
        Message = "Meeting Has Been Added Successfully."
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
        else if (formName == "meetingForm") {
            Message = "Meeting Has Been Deleted Successfully."
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
                    $('#notifications').find('.lv-body').html("");
                    $.each(e,function(k,v){
                        item = $('<a class="lv-item" href=""><div class="media">' +
                            '<div class="pull-left">' +
                            ' <img class="lv-img-sm" src="img/profile-pics/1.jpg" alt="">' +
                            ' </div>' +
                            ' <div class="media-body">' +
                            '<div class="lv-title">'+ v.name +'</div>' +
                            '<small class="lv-small">'+ v.subject +'</small>' +
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

function saveAdvanceEvent(formName){
    debugger;
    var Message = "";
    var createddate = getOnlyCurrentDate();
    var timeslot;
    var location;
    var street ,city,state,country;
    var locationid;

    var type =$('#Type').find("option:selected").val();;

    if (type == "1") {
        Message = "Meeting Has Been Added Successfully.";
    }
    else if (type == "2") {
        Message = "Note Has Been Added Successfully.";
    }

    if($('#fullday:checkbox:checked').length > 0){
        //fullday
        timeslot="&timeslotid=0&starttime=0&endtime=0";
    }
    else
    {   //time entered
        timeslot="&timeslotid=1&starttime="+$("#StartTime").val();+"&endtime="+$("#EndTime").val();
    }

    if($('#addLocation:checkbox:checked').length > 0){

        street = $("#street").val();
        city = $("#city").val();
        state = $("#state").val();
        country = $("#country").val();
        location ="&street="+street+"&city="+city+"&state="+state+"&country="+country;
    }
    else{
        location = "&street=0&city=0&state=0&country=0&locationid=0";
    }

    $.ajax({
        url: "process/index.php?route=event&method=insertAdvanceEvent",
        type: "post",
        dataType: 'json',
        data: $('#' + formName).serialize()+"&createddate="+createddate+timeslot+location, // provided this code executes in form.onsubmit event
        success: function (output) {
            debugger;
            $('#' + formName)[0].reset();
            if (output.success > 0) {
                clearSessionsForAdvanceNote();
                showalert(Message, "alert-success", "/Online-Calender/Calendar.html", "redirect");
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

function updateAdvanceEvent(formName){

    var Message = "";
    var timeslot;
    var location;
    var street ,city,state,country;
    var locationid;
    var noteid = localStorage.getItem("advanceID");

    var type =$('#Type').find("option:selected").val();

    if (type == "1") {
        Message = "Meeting Has Been Updated Successfully.";
    }
    else if (type == "2") {
        Message = "Note Has Been Updated Successfully.";
    }

    if($('#fullday:checkbox:checked').length > 0){
        //fullday
        timeslot="&timeslotid=0&starttime=0&endtime=0";
    }
    else{   //time entered
        timeslot="&timeslotid=1&starttime="+$("#StartTime").val()+"&endtime="+$("#EndTime").val();
    }

    if($('#addLocation:checkbox:checked').length > 0){
        //location entered
        locationid = $("#locationId").val();
        street = $("#street").val();
        city = $("#city").val();
        state = $("#state").val();
        country = $("#country").val();
        location ="&street="+street+"&city="+city+"&state="+state+"&country="+country+"&locationid="+locationid+"&locationflag=N";
    }
    else{
        //no location
        locationid = $("#locationId").val();
        location = "&street=0&city=0&state=0&country=0&locationid="+locationid+"&locationflag=U";
    }
   // console.log($('#' + formName).serialize());
    $.ajax({
        url: "process/index.php?route=event&method=updateAdvanceEvent",
        type: "post",
        dataType: 'json',
        data: $('#' + formName).serialize()+timeslot+location+"&noteid="+noteid, // provided this code executes in form.onsubmit event
        success: function (output) {
            debugger;
            $('#' + formName)[0].reset();
            if (output.success > 0) {
                clearSessionsForAdvanceNote();
                showalert(Message, "alert-success", "/Online-Calender/Calendar.html", "redirect");
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