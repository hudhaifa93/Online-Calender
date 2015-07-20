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
            return d.getFullYear() + "-" + (d.getMonth() + 1 > 9 ? "" : "0") + (d.getMonth() + 1) + "-" + (d.getDate() > 9 ? "" : "0") + d.getDate();
            break;
        case "m-d":
            return (d.getMonth() + 1 > 9 ? "" : "0") + (d.getMonth() + 1) + "-" + (d.getDate() > 9 ? "" : "0") + d.getDate();
            break;
        case "y":
            return d.getFullYear() ;
            break;
        case "m":
            return (d.getMonth() + 1 > 9 ? "" : "0") + (d.getMonth() + 1) ;
            break;
        case "d":
            return  (d.getDate() > 9 ? "" : "0") + d.getDate();
            break;
        case "D" :
            return title_name.daysMin[d.getDay()];
            break;
        default :
            return d.getFullYear() + "-" + (d.getMonth() + 1 > 9 ? "" : "0") + (d.getMonth() + 1) + "-" + (d.getDate() > 9 ? "" : "0") + d.getDate();
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
        url: "process/index.php?route=user&method=validateLogin",//event.php
        type: "post",
        dataType: 'json',
        data: $('#' + formName).serialize(), // provided this code executes in form.onsubmit event
        success: function (output) {
            debugger;
            //$('#'+formName)[0].reset();
            if (output.success > 0) {
                localStorage.setItem("memberId", output.success);
                localStorage.setItem("advanceID", "0");
                location.reload();
                //window.location.href = "/Online-Calender/Calendar.html";

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
            url: "process/index.php?route=user&method=createNewSignUp",//event.php
            type: "post",
            dataType: 'json',
            data: $('#'+formName).serialize(), // provided this code executes in form.onsubmit event
            success: function (output) {
                debugger;
                $('#'+formName)[0].reset();
                if(output.success > 0)
                {
                    localStorage.setItem("memberId", output.success);
                    localStorage.setItem("advanceID", "0");
                    showalert(Message,"alert-success","/Online-Calender/","redirect");
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
//        $.ajax({
//            url : "process/?route=event&method=shareEvent",
//            type: "post",
//            dataType: "json",
//            success :function(e){
//                if(e.length > 0 ){
//                    $('#notifications').find('.lv-body').html("");
//                    $.each(e,function(k,v){
//                        item = $('<a class="lv-item" href=""><div class="media">' +
//                            '<div class="pull-left">' +
//                            ' <img class="lv-img-sm" src="img/profile-pics/1.jpg" alt="">' +
//                            ' </div>' +
//                            ' <div class="media-body">' +
//                            '<div class="lv-title">'+ v.name +'</div>' +
//                            '<small class="lv-small">'+ v.subject +'</small>' +
//                            ' </div>' +
//                            ' </div>' +
//                            '</a>');
//                        $('#notifications').find('.lv-body').append(item);
//                    });
//                    $('.tm-notification').html( '<i class="tmn-counts" >'+e.length+'</i>');
//                }
//            }
//        });
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
    var repeatData;

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
        timeslot="&timeslotid=1&starttime="+$("#StartTime").val()+"&endtime="+$("#EndTime").val();
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

    if($('#repeat:checkbox:checked').length > 0){

        var repeats = $('#repeats').find("option:selected").val();
        repeatData ="&repeat="+repeats;
    }
    else{
        repeatData="&repeat=";
    }

    $.ajax({
        url: "process/index.php?route=event&method=insertAdvanceEvent",
        type: "post",
        dataType: 'json',
        async:false,
        data: $('#' + formName).serialize()+"&createddate="+createddate+timeslot+location+repeatData, // provided this code executes in form.onsubmit event
        success: function (output) {
            debugger;
            $('#' + formName)[0].reset();
            if (output.success > 0) {
                inviteList(output.success,"N");
                clearSessionsForAdvanceNote();
                showalert(Message, "alert-success", "/Online-Calender/", "redirect");
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

    var createddate = getOnlyCurrentDate();
    var Message = "";
    var timeslot;
    var location;
    var street ,city,state,country;
    var locationid;
    var repeatid;
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

    if($('#repeat:checkbox:checked').length > 0){

        var repeats = $('#repeats').find("option:selected").val();
        repeatData ="&repeat="+repeats;
    }
    else{
        repeatData="&repeat=";
    }
    $.ajax({
        url: "process/index.php?route=event&method=updateAdvanceEvent",
        type: "post",
        dataType: 'json',
        async:false,
        data: $('#' + formName).serialize()+timeslot+location+"&noteid="+noteid+repeatData, // provided this code executes in form.onsubmit event
        success: function (output) {
            debugger;
            $('#' + formName)[0].reset();
            if (output.success > 0) {
                inviteList(output.success,"U");
                clearSessionsForAdvanceNote();
                showalert(Message, "alert-success", "/Online-Calender/", "redirect");
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

function inviteList(noteid,flag){
    debugger

    var email = [] ;
    var str ="";
    $( ".tags" ).each(function( index ) {
        debugger;
        if(flag=="N"){

            str = $( this ).text();
            str = str.split("x");
            email.push({
                "noteid" : noteid,
                "email" : str[0],
                "status" : 0 });

        }
        else
        {
            str = $( this ).text();
            str = str.split("x");
            email.push({
                "noteid" : noteid,
                "email" : str[0],
                "status" : $( this ).data('status') });
        }


    });

    $.ajax({
        url: "process/index.php?route=event&method=inviteMembers",
        type: "post",
        dataType: 'json',
        data: { inviteArray : email}, // provided this code executes in form.onsubmit event
        success: function (output) {

        },
        failure: function () {

        }
    });


}

function ShareCalenderList(memberid){
    debugger
    var email = [] ;
    var str ="";
    $( ".tags" ).each(function( index ) {
        debugger;

            str = $( this ).text();
            str = str.split("x");
            email.push({
                "memberid" : memberid,
                "sharedmemberemail" : str[0],
                "status" : $( this ).data('status') });

    });
    if(email.length>0){
        $.ajax({
            url: "process/index.php?route=event&method=setSharedMemberIds",
            type: "post",
            dataType: 'json',
            data: { sharedMembersList : email}, // provided this code executes in form.onsubmit event
            success: function (output) {
                if(output="success"){
                    showalert("Calender Shared", "alert-success", "", "");
                }
                else
                {
                    showalert("Calender Not Shared", "alert-danger", "", "");
                }
            },
            failure: function () {
                showalert("Calender Not Shared", "alert-danger", "", "");
            }
        });
    }
}

function loadShareCalenderList(memberid){
    $("#InvitedList").html('');
    $.ajax({
        url: "process/index.php?route=event&method=getSharedMemberIds",
        type: "post",
        dataType: 'json',
        async:false,
        data: "memberid="+memberid, // provided this code executes in form.onsubmit event
        success: function (e) {

            var data = e;
            data = JSON.parse(data.success);

            $("#InvitedList").html('');

            $.each( data, function( key, value ) {
                debugger;
                var Email = value.sharedmemberemail;
                var fullEmail = Email;
                Email = Email.split("@");
                $("#InvitedList").append($('<div data-status="'+value.status+'" class="tags ' + Email[0] + 'List" >' + fullEmail + ' <a class="" onclick="removeFromInvitedList(' + "'" + Email[0] + "'" + ')">x</a></div>'));
            });


        },
        failure: function () {

        }
    });
}

function loadSharedCalenderList(memberid){
    debugger;
    $("#sharedList").html('');
    $.ajax({
        url: "process/index.php?route=event&method=getSharedMemberDetailsByMemberId",
        type: "post",
        dataType: 'json',
        async:false,
        data: "memberid="+memberid, // provided this code executes in form.onsubmit event
        success: function (e) {
            debugger;
            var data = e;
            data = JSON.parse(data.success);
            $.each( data, function( key, value ) {
               $("#sharedList").append($("<input type='checkbox' style='margin-right: 10px;' class='shareCheckBox' id='"+value.id+"' ><label id='label"+value.id+"'>"+value.firstname+" "+value.lastname+"</label><br>"));
            });
        },
        failure: function () {

        }
    });
}

function drawSharedCalender(){
    var sharedClicked = [];
    $('.shareCheckBox').each(function(i, obj) {
       if(this.checked){
           sharedClicked.push({
               "memberid" : this.id,
               "name" : $("#label"+this.id).text()
           });
       }
    });
    localStorage.setItem("sharedClicked",JSON.stringify(sharedClicked));
    $('#ViewShareModal').modal('hide');
}

logout();
function logout(){
    $('.logout').click(function(e){
        $.ajax({
            url : "process/?route=user&method=logout",
            success : function(){
                location.reload();
            }
        });
        return false;
    });
}

function openShareModal(){
    $('#shareCalenderModal').modal('show');
}

share();
function share(){
    $('body').on( 'click' , '.share' ,function(e){
        $('#share').modal('show');
        m=$('#share').find('.modal-body');
        frm=$('<form >').append('<input type="email" name="email" > <button id="share_from" type="button"  >Share</button>');
        frm.data('id',$(this).data('id'));
        frm.data('type',$(this).data('type'));
        m.html(frm);
    })
        .on('click','#share_from',function(){
            $('#share').modal('hide');
            frm = $(this).closest('form');
            data = frm.serialize()+"&id="+frm.data('id')+"&type="+frm.data('type');
            $.ajax({
                url : 'process/?route=event&method=share' ,
                type:'post',
                data : frm.serialize()+"&id="+frm.data('id')+"&type="+frm.data('type') ,
                success: function(e){
                    console.log(e);
                }
            });
            return false;
        });

}
/*

 <div id="share" class="modal fade">
 <div class="modal-dialog modal-lg">
 <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
 <h4 class="modal-title" > Share </h4>
 </div>
 <div class="modal-body" >
 <input type="email" multiple  >
 </div>
 </div>
 </div>
 </div>
 */
