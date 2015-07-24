
function showalert(message, alerttype, id, type) {

    if (type == "modal") $('#' + id).modal('toggle');

    if(alerttype=="alert-success"){
        swal({
            title: "Good job!",
            text: message,
            type: "success",
            showCancelButton: false,
            confirmButtonColor: "#AEDEF4",
            confirmButtonText: "OK",
            closeOnConfirm: false }, function(){


            if(type=="redirect"){
                 window.location.href = id;
            }
            else{
                location.reload();
            }


            });
    }
    else{
        swal({
            title: "Ouch !",
            text: message,
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#AEDEF4",
            confirmButtonText: "OK",
            closeOnConfirm: false }, function(){

            location.reload();

        });
    }
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
    debugger
    localStorage.setItem("advanceID", "0");
    localStorage.setItem("tempSubject", $("#Subject").val());
    localStorage.setItem("tempDescription", $("#description").val());
    localStorage.setItem("tempClickedDate", date);
    window.location.href = "ConfigureEvents.php";
}

function clearSessionsForAdvanceNote() {
    localStorage.setItem("advanceID", "0");
    localStorage.setItem("tempSubject", "0");
    localStorage.setItem("tempDescription", "0");
    localStorage.setItem("tempClickedDate", "0");
}

function editAdvanceNote(id) {

    localStorage.setItem("advanceID", id);
    window.location.href = "ConfigureEvents.php";
}

function validateLogin(formName) {

    $.ajax({
        url: "process/index.php?route=user&method=validateLogin",//event.php
        type: "post",
        dataType: 'json',
        data: $('#' + formName).serialize(), // provided this code executes in form.onsubmit event
        success: function (output) {
            /* debugger */;
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
    var Message="";
    Message ="You Have Been Successfully Registered.";

    $.ajax({
            url: "process/index.php?route=user&method=createNewSignUp",//event.php
            type: "post",
            dataType: 'json',
            data: $('#'+formName).serialize(), // provided this code executes in form.onsubmit event
            success: function (output) {
                /* debugger */;
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
            /* debugger */;
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
            /* debugger */;
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

        swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this Event !",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(){
            $.ajax({
                url: "process/index.php?route=event&method=deleteBasicEvent",//event.php
                type: "post",
                dataType: 'json',
                data: $('#' + formName).serialize()+"&id="+id, // provided this code executes in form.onsubmit event
                success: function (output) {
                    /* debugger */;
                    $('#' + formName)[0].reset();
                    if (output.success == "Deleted") {
                        showalert(Message, "alert-success", "CommonViewModal", "modal");
                    }
                    else {
                        showalert("An Error Occurred Please Contact Admin.", "alert-danger", "", "");
                    }
                },
                failure: function () {
                    showalert("An Error Occurred Please Contact Admin.", "alert-danger", "", "");
                }
            });

        });


    }

function saveAdvanceEvent(formName){
    /* debugger */;
    var Message = "";
    var createddate = getOnlyCurrentDate();
    var timeslot;
    var location;
    var street ,city,state,country;
    var locationid;
    var repeatData;
    var longitude;
    var latitude;

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
        timeslot="&timeslotid=1&starttime="+$("#StartTime").val().replace(":", "")+"&endtime="+$("#EndTime").val().replace(":", "");
    }

    if($('#addLocation:checkbox:checked').length > 0){

        street = $("#street").val();
        city = $("#city").val();
        state = $("#state").val();
        country = $("#country").val();
        longitude=$("#longitude").val();
        latitude=$("#latitude").val();

        location ="&street="+street+"&city="+city+"&state="+state+"&country="+country+"&longitude"+longitude+"&latitude"+latitude;
    }
    else{
        location = "&street=0&city=0&state=0&country=0&locationid=0&longitude=0&latitude=0";
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
            /* debugger */;
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
    var longitude;
    var latitude;

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
        timeslot="&timeslotid=1&starttime="+$("#StartTime").val().replace(":", "")+"&endtime="+$("#EndTime").val().replace(":", "");
    }

    if($('#addLocation:checkbox:checked').length > 0){
        //location entered
        locationid = $("#locationId").val();
        street = $("#street").val();
        city = $("#city").val();
        state = $("#state").val();
        country = $("#country").val();
        location ="&street="+street+"&city="+city+"&state="+state+"&country="+country+"&locationid="+locationid+"&locationflag=N&longitude"+longitude+"&latitude"+latitude;
    }
    else{
        //no location
        locationid = $("#locationId").val();
        location = "&street=0&city=0&state=0&country=0&locationid="+locationid+"&locationflag=U&longitude=0&latitude=0";
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
            /* debugger */;
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
    var email = [] ;
    var str ="";
    $( ".tags" ).each(function( index ) {
        /* debugger */;
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

function ShareCalenderList(memberid){//called to set shared members or update shared members
    var email = [] ;
    var str ="";
    $( ".tags" ).each(function( index ) {
        /* debugger */;

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
                /* debugger */;
                if(output="success"){
                    showalert("Calender Shared / Updated", "alert-success", "", "");
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
            /* debugger */;
            data = JSON.parse(data.success);

            $("#InvitedList").html('');
            $.each( data, function( key, value ) {
                    /* debugger */;
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
    $("#sharedList").html('');
    $.ajax({
        url: "process/index.php?route=event&method=getSharedMemberDetailsByMemberId",
        type: "post",
        dataType: 'json',
        async:false,
        data: "memberid="+memberid, // provided this code executes in form.onsubmit event
        success: function (e) {
            /* debugger */;
            var data = e;
            data = JSON.parse(data.success);
            if(data=="" || data==[])
            {
                $("#sharedList").append("<div>Calenders Not Shared With  You.</div>");
                localStorage.setItem("sharedClicked","");
            }
            else
            {
                $.each( data, function( key, value ) {
                   $("#sharedList").append($("<input type='checkbox' style='margin-right: 10px;' class='shareCheckBox' id='"+value.id+"' ><label id='label"+value.id+"'>"+value.firstname+" "+value.lastname+"</label><br>"));
                });
            }
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
    location.reload();
}

function openShareModal(){
    $('#shareCalenderModal').modal('show');
}

function loadConfigureModelDetails(memberid){
    debugger;
    $("#configureDetails").html('');
    $.ajax({
        url: "process/index.php?route=event&method=getNoteConfigurationByMemberId",
        type: "post",
        dataType: 'json',
        async:false,
        data: { MemberId: memberid},
        success: function (data) {
            for(var i=0;i<data.length;i++){
                if(data[i].notetypeid == "1"){
                    $("#Color_Type_Meeting").val(data[i].colorcode);
                    $("#Color_Type_Meeting").attr("class","color_type " + data[i].colorcode);
                }else if(data[i].notetypeid == "2"){
                    $("#Color_Type_Note").val(data[i].colorcode);
                    $("#Color_Type_Note").attr("class","color_type " + data[i].colorcode);
                }else if(data[i].notetypeid == "3"){
                    $("#Color_Type_BirthDay").val(data[i].colorcode);
                    $("#Color_Type_BirthDay").attr("class","color_type " + data[i].colorcode);
                }
            }
        },
        failure: function () {

        }
    });
}

function saveConfigureCalendar(){
    var meeting = $("#Color_Type_Meeting").val();
    var note = $("#Color_Type_Note").val();
    var birthday = $("#Color_Type_BirthDay").val();

    $.ajax({
        url: "process/index.php?route=event&method=saveNoteConfiguration",
        type: "post",
        dataType: 'json',
        data: "&meeting="+meeting+"&note="+note+"&birthday="+birthday+"&memberId="+localStorage.getItem("memberId"),
        success: function (output) {
            showalert("Event Colors Successfully Updated.", "alert-success", "ConfigureModal", "modal");
        },
        failure: function () {
        }
    });
}

getNotification();
function getNotification(){
    getData();
    setInterval(function(){
        getData();
    },5000);

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
                        n = v.name.split(" ");
                        item = $('<a class="lv-item"></a>');
                        $('<div class="media">' +
                            '<div class="pull-left circleBase type2" style="background: '+"#"+Math.floor(Math.random()*16777215).toString(16)+'" >' +
                            " <span class='result_image' >"+n[0].charAt(0).toUpperCase()+"<small>"+n[1].charAt(0).toLowerCase()+"</small></span> " +
                            ' </div>' +
                            ' <div class="media-body">' +
                            '<div class="lv-title">'+ v.name +'</div>' +
                            '<small class="lv-small">'+ v.subject +'</small>' +
                            ' </div>' +
                            ' </div>' ).appendTo(item);
                        if(typeof  v.share != 'undefined'){
                            if(v.share == 1)
                                item.data('member_id', v.id).data('share',true).data('name',v.name).addClass('sharedCalendar');
                            else if(v.share == 2)
                                item.data('noteid', v.id).data('share',true).data('name',v.name).addClass('invite');
                        }
                        $('#notifications').find('.lv-body').append(item);
                    });
                    $('.tm-notification').html( '<i class="tmn-counts" >'+e.length+'</i>');
                }
            }
        });
        $('#notifications').on('click','.sharedCalendar,.invite',function(){
            self = $(this);
            bootbox.dialog({
                message: "Request for share Calendar",
                title: self.data('name'),
                buttons: {
                    success: {
                        label: "Confirm",
                        className: "btn-success",
                        callback: function() {
                            if(self.hasClass('invite'))
                                changeInviteRequest(1);
                            else if(self.hasClass('sharedCalendar'))
                                changeShare(1);
                        }
                    },
                    danger: {
                        label: "Delete Request",
                        className: "btn-danger",
                        callback: function() {
                            if(self.hasClass('invite'))
                                changeInviteRequest(2);
                            else if(self.hasClass('sharedCalendar'))
                                changeShare(2);
                        }
                    }}
            });
            function changeShare(v){
                $.ajax({
                    url : "process/?route=event&method=updateSharedCalendar",
                    data: { memberid:self.data('member_id') , val:v },
                    type:'post',
                    success :function(){
                        location.reload();
                    }
                });
            }
            function changeInviteRequest(v){
                $.ajax({
                    url : "process/?route=event&method=updateInviteRequest",
                    data: { noteid:self.data('noteid') , val:v },
                    type:'post',
                    success :function(){
                        location.reload();
                    }
                });
            }
        });
    }
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

share();
function share(){
    $('body').on( 'click' , '.share' ,function(e){
        $('#share').modal('show');
        $('#shareList')
            .data('id',$(this).data('id'))
            .data('type',$(this).data('type'));
    })
        .on('click','#share_from',function(){
            $('#share').modal('hide');
            frm = $('#shareList');
            data = frm.serialize()+"&id="+frm.data('id')+"&type="+frm.data('type');
            $.ajax({
                url : 'process/?route=event&method=share' ,
                type:'post',
                data : frm.serialize()+"&id="+frm.data('id')+"&type="+frm.data('type') ,
                success: function(e){
                    $("#shareList").html("");
                    console.log(e);
                }
            });
            return false;
        });

}

function loadViewModaData(id,type){

    $("#CommonViewModal label").hide();
    $("#CommonViewModal label").text('');
    $("#CommonViewModal input").val('');
    $("#birthdayedit").hide();

    $.ajax({
        url: "process/index.php?route=event&method=getAdvanceEventData",//event.php
        type: "post",
        dataType: 'json',
        async:false,
        data:"id="+id,
        success: function (e) {
            /* debugger */;
            var data = e;
            data = JSON.parse(data.success);
            var dataLength = data.length;
            data = data[0];
            if (dataLength > 0) {
                $("#ViewSubject").text(data.subject);$("#ViewSubject").show();
                $("#ViewDescription").text(data.description);$("#ViewDescription").show();
                if(type!="Birthday"){
                    $("#ViewStartDate").text(data.startdate);$("#ViewStartDate").show();
                    $("#ViewEndDate").text(data.enddate);$("#ViewEndDate").show();
                }
                else{
                    $("#birthdayedit").show();
                    $("#ViewSubject").hide();
                    $("#ViewDescription").hide();
                    $("#EBirthDayName").val(data.subject).attr('readonly',true);
                    $("#EBdate").val(dateFormat(new Date(data.startdate),'d')).attr('readonly',true);
                    $("#EBmonth").val(dateFormat(new Date(data.startdate),'m')).attr('readonly',true);
                    $("#EByear").val(dateFormat(new Date(data.startdate),'y')).attr('readonly',true);
                }
                if(data.timeslotid=="1")
                {
                    $("#ViewStartTime").text(getHourlyTime(data.starttime));$("#ViewStartTime").show();
                    $("#ViewEndTime").text(getHourlyTime(data.endtime));$("#ViewEndTime").show();
                }
                if(data.location != "0")
                {
                    $('#ViewLocation').text(data.street+" "+data.city+" "+data.state+" "+data.country);$("#ViewLocation").show();
                }
                $("#ViewInviteList").hide();
                $.ajax({
                    url: "process/index.php?route=event&method=getinvitebynoteid",
                    type: "post",
                    dataType: 'json',
                    async:false,
                    data: "noteid="+id, // provided this code executes in form.onsubmit event
                    success: function (e) {
                        /* debugger */;
                        var data = e;
                        data = JSON.parse(data.success);

                        $("#ViewInviteList").html('');

                        $.each( data, function( key, value ) {
                            /* debugger */;
                            var Email = value.email;
                            var fullEmail = Email;
                            Email = Email.split("@");
                            $("#ViewInviteList").append($('<div data-status="'+value.status+'" class="tags ' + Email[0] + 'List" >' + fullEmail + '</div>'));
                        });
                        if(data!=[]){
                            $("#ViewInviteList").show();
                        }


                    },
                    failure: function () {

                    }
                });
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

$('#txtSearch').keyup(function(){
    self = $(this);

    if(self.val().length>0){
        self.addClass('loading');
        $('.search_result').removeClass('hidden');
        $.ajax({
            url :"process/?route=event&method=search&str="+self.val(),
            dataType:'json',
            data : {memberid:getMemberIds()},
            type : 'post',
            success: function(e){
                    self.removeClass('loading');
                $('.search_result').html("");
                for(a in e){
                    $("<a class='result_event' data-createdby='"+e[a].createdby+"' data-eventid='"+e[a].id+"' data-eventtype='"+e[a].notetype+"' >  " +
                        " <span class='result_image' >"+e[a].firstname.charAt(0).toUpperCase()+"<small>"+e[a].lastname.charAt(0).toLowerCase()+"</small></span> " +
                        " <span class='result_data' >" +
                        "<span class='result_sub' >"+e[a].subject+"</span> <span class='result_des' >"+e[a].description.substring(0,75)+ ( e[a].description.length > 75 ? "..." : "" )+"</span>"+
                        "</span> " +
                        "  </a>").appendTo('.search_result');
                }

            }
        });
    }else{
        $('.search_result').addClass('hidden').html("");
        self.removeClass('loading');
    }

});

$('.main').click(function(){$('.search_result').addClass('hidden').html("");});

$('.search_result').on('click','.result_event',function(){
    $('.search_result').addClass('hidden').html("");
    $("#txtSearch").val("");
    event = $(this);
    $('#CommonViewModal').modal('show').find('.share').remove();
    if(event.data('eventtype')=="1")//meeting
    {

        $("#viewHead").text("Meeting");
        if(event.data('createdby')==localStorage.getItem("memberId"))
        {
            $('#editButton').attr("onclick","editAdvanceNote("+event.data('eventid')+")");
            $("#viewButtonDelete").attr("onclick","deleteBasicEvent('eventForm','"+event.data('eventid')+"')");
            $('#editButton').show();
            $("#viewButtonDelete").show();
        }
        else
        {
            $('#editButton').hide();
            $("#viewButtonDelete").hide();
        }

    }
    if(event.data('eventtype')=="2"){
        var btn=$('<button class="share btn btn-primary  " type="button" > Share </button>');
        btn.data('id',event.data('eventid'));
        btn.data('type',event.data('eventtype'));
        $('#editButton').before(btn);

        $("#viewHead").text("Note");
        $("#ViewSubject").text(event.data('subject'));
        $("#ViewDescription").text(event.data('description'));
        loadViewModaData(event.data('eventid'),'Note');
        if(event.data('createdby')==localStorage.getItem("memberId"))
        {
            $('#editButton').attr("onclick","editAdvanceNote("+event.data('eventid')+")");
            $("#viewButtonDelete").attr("onclick","deleteBasicEvent('eventForm','"+event.data('eventid')+"')");
            $('#editButton').show();
            $("#viewButtonDelete").show();
        }
        else
        {
            $('#editButton').hide();
            $("#viewButtonDelete").hide();
        }
    }
    if(event.data('eventtype')=="3"){
        var btn=$('<button class="share btn btn-primary  " type="button" > Share </button>');
        btn.data('id',event.data('eventid'));
        btn.data('type',event.data('eventtype'));

        $('#editButton').before(btn);
        $("#viewHead").text("Birthday");
        loadViewModaData(event.data('eventid'),'Birthday');

        if(event.data('createdby')==localStorage.getItem("memberId"))
        {
            $("#viewButtonDelete").attr("onclick","deleteBasicEvent('eventForm','"+event.data('eventid')+"')");
            $("#viewButtonDelete").show();
        }
        else
        {
            $("#viewButtonDelete").hide();
        }
    }

});

$('#profile-logo').css('background', "#"+Math.floor(Math.random()*16777215).toString(16));


function makebirthdayEditable(id){
    debugger;
    $("#EBirthDayName").attr('readonly',false);
    $("#EBdate").attr('readonly',false);
    $("#EBmonth").attr('readonly',false);
    $("#EByear").attr('readonly',false);
    $('#editButton').attr("onclick","updateBirthday('"+id+"')");
    $('#editButton').html('Update');

}

function updateBirthday(id)
{
    $('#editButton').html('Edit');
    var Bdate = $("#EByear").val() + "-" + $("#EBmonth").val() + "-" + $("#EBdate").val();
    var  Message = "Birthday Has Been Updated Successfully.";
    var subject =  $("#EBirthDayName").val();
    $.ajax({
        url: "process/index.php?route=event&method=updateBirthday",//event.php
        type: "post",
        dataType: 'json',
        data: "id="+id+"&date="+Bdate+"&subject="+subject, // provided this code executes in form.onsubmit event
        success: function (output) {
            if (output.success > 0) {
                showalert(Message, "alert-success", "CommonViewModal", "modal");
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


$('[data-toggle="tooltip"]').tooltip();

$(".createdby").val(localStorage.getItem("memberId"));
loadShareCalenderList(localStorage.getItem("memberId"));
loadSharedCalenderList(localStorage.getItem("memberId"));
//loadConfigureModelDetails(localStorage.getItem("memberId"));
$("#shareCalenderButton").attr("onclick","ShareCalenderList('"+localStorage.getItem("memberId")+"')");

$(".viewshareCal").click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    if(localStorage.getItem("sharedClicked")=="" || localStorage.getItem("sharedClicked")==[] || localStorage.getItem("sharedClicked")==null){

    }
    else
    {
        var sharedobject = jQuery.parseJSON(localStorage.getItem("sharedClicked"));
        $('.shareCheckBox').prop('checked', false);
        $.each(sharedobject, function(index, value) {
            $('#'+value.memberid).prop('checked', true);
        });
    }
    $('#ViewShareModal').modal('show');

    return false;
} );

$(".shareCal").click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    $('#ShareModal').modal('show');
    return false;
} );

$(".export").click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    window.location.href="savepdf.php";
    return false;
} );

$(".configure").click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    loadConfigureModelDetails(localStorage.getItem("memberId"));
    $('#ConfigureModal').modal('show');
    return false;
});

$('.color_type').on('change', function (e) {
    var cc = this.value;
    $(this).attr("class","color_type " + cc);
});
var app1 = new calendar({
    id : 'min_cal',
    view : 'month',
    min : true
});
$(".min-calendar").click(function(e){
    e.stopPropagation();
    $("#min_cal").toggleClass('hidden');
});