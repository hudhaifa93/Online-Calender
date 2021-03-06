<?php include 'include/head.php' ?>
<?php
if(!session::get('user')){
    header('Location: index.php');
}
?>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">


    <style type="text/css">
        body {
            margin: 0px auto;
            margin-top:20px;
            background-color:#CCCCCC;
        }
        .bs-example {
            margin: 20px;
        }
        .modal-footer {
            border-top: 0px !important;
        }
        .bootstrap-tagsinput {
            width: 100%;
        }

        .modal .modal-body {
            max-height: 420px;
            overflow-y: auto;
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
            border-color: #eee #eee #0a6ebd;
        }
        .nav-tabs {
            border-bottom: 1px solid #ddd;
        }
        #txtSearch {
            border: 0;
            height: 40px;
            padding: 0 10px 0 40px;
            font-size: 18px;
            width: 500px;
            border-radius: 2px;
            color: white;
            background-color: rgba(255, 255, 255, 0.26);
            background-image: url("././img/icons/search.png");
            background-repeat: no-repeat;
            background-position: 10px center;
        }
        .bootstrap-tagsinput {
            width: 100%;
        }


        #footer{
            background-color: #f44336;
            box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.3);
            height: 100px;
            z-index: 10;
            width: 100%;
            left: 0;
            padding-right: 10px;
            bottom: 0;
            -webkit-transition: all;
            -o-transition: all;
            transition: all;
            -webkit-transition-duration: 200ms;
            transition-duration: 200ms;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .form-control
        {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }

        .ui-timepicker-hours {padding-right: 10px;}
        .ui-timepicker{margin-top: 10px;}
        .periods{padding-right: 10px;}

        .fade.in {
            opacity: 1;
        }
        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
    </style>

    <body>

        <?= include "include/header.php" ?>


        <section class="main" >
            <div class="content" >
                <div class="container" >
                    <div class="block-header">
                        <h2>&nbsp;</h2>
                        <h2>&nbsp;</h2>
                    </div>


                    <div class="clearfix" ></div>
                    <div style="background-color:#FFFFFF; overflow: auto;" > <!--heshani added a new div-->

                        <form role="form" id="frmMeeting">

                            <input type=hidden name=status value="1">
                            <input type=hidden name=createdby id="createdby" value="">
                            <input type=hidden id="notetype" name=notetype value="1">
                            <input type=hidden id="locationId"  value="">
                            <input type=hidden id="repeatId"  value="">

                            <div class="col-xs-6 form-group" style="margin-top:15px;">
                                <label>Type</label>
                                <select name="" id="Type" class="form-control" style="width:30%;">
                                    <option value="1">Meeting</option>
                                    <option value="2">Note</option>
                                    <!--<option value="3">Birthday</option>-->
                                </select>
                            </div>
                            <div class="col-xs-6 form-group">
                                <button type="button" class="btn btn-sm btn-info pull-right" style="margin-top: 30px;" onclick="window.history.back()">Back</button>
                            </div>
                            <div class="col-xs-12 form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control" data-validate="require" name="subject" id="Subject" placeholder="Subject"/>
                            </div>

                            <div class="col-xs-12 form-group">
                                <label>Location</label>
                                <input type="checkbox" id="addLocation">
                            </div>

                            <div id="locationAllocation" style="display:none;">
                                <div class="col-xs-6 form-group">
                                    <div id="map-canvas" style="width:100%;height:250px;"></div>
                                </div>
                                <div class="col-xs-6 form-group">
                                    <input type="text" class="form-control" id="autocomplete" placeholder="Enter your address"/>
                                    <input type="text"  style="margin-top: 10px;margin-bottom: 10px;" class="googleAddress form-control" id="street" placeholder="Street"/>
                                    <input  style="float: left;  width: 25%;  margin-right: 10px;" type="text" class="googleAddress form-control" id="city" placeholder="City"/>
                                    <input  style="float: left;  width: 25%;  margin-right: 10px;" type="text" class="googleAddress form-control" id="state" placeholder="State"/>
                                    <input  style="float: left;  width: 25%;" type="text" class="googleAddress form-control" id="country" placeholder="Country"/>
                                    <input style="float: left;  width: 25%;  margin-right: 10px;margin-top: 10px;" type="text" class="googleAddress form-control" id="latitude" name="latitude" placeholder="Latitude" readonly/>
                                    <input style="float: left;  width: 25%;margin-top: 10px;" type="text" class="googleAddress form-control" id="longitude" name="longitude" placeholder="Longitude" readonly/>

                                </div>


                            </div>
                            <div class="clearfix" ></div>
                            <div class="col-xs-6 form-group">
                                <label>Start Date</label>
                                <input type="text" class="form-control" name="startDate" id="StartDate" placeholder="Start Date"/>
                            </div>
                            <div class="col-xs-6 form-group">
                                <label>End Date</label>
                                <input type="text" class="form-control" name="endDate" id="EndDate" placeholder="End Date"/>
                            </div>
                            <div class="col-xs-12 form-group">
                                <label>Full Day</label>
                                <input type="checkbox" id="fullday" checked="checked">
                            </div>
                            <div id="timeAllocation" style="display:none">
                                <div class="col-xs-6 form-group">
                                    <label>Start Time</label>
                                    <input type="text" class="form-control" name="" id="StartTime" placeholder="Start Time"/>
                                </div>
                                <div class="col-xs-6 form-group">
                                    <label>End Time</label>
                                    <input type="text" class="form-control" name="" id="EndTime" placeholder="End Time"/>
                                </div>
                            </div>
                            <div class="col-xs-12 form-group">
                                <label>Repeat</label>
                                <input type="checkbox" id="repeat" >
                            </div>
                            <div id="repeatAllocation" style="display:none">
                                <div class="col-xs-6 form-group"><!--put a b color or something for this -->
                                    <div class="col-xs-6 form-group">
                                        <select name="" id="repeats" class="form-control" style="">
                                            <option value="M">Monthly</option>
                                            <option value="W">Weekly</option>
                                            <option value="Y">Yearly</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xs-12 form-group">
                                <label>Meeting Description</label>
                                <textarea class="form-control custom-control" name="description" id="Description" rows="5" style="resize:none" placeholder="Meeting Description"></textarea>
                            </div>
                        </form>

                        <form id="inviteeForm" style="margin-top:10px">
                            <div class="col-xs-6 form-group" style="margin-top:10px;">
                                <input type="email"  class="form-control"  id="MeetingInviteeEmail" placeholder="InviteeEmail"/><button type="button" style=" float: left;  margin-top: 5px;" class="btn btn-sm btn-primary"onclick="addToInvitedList()">Add to List</button>
                                <!--<button type="button" style="  margin-left: 10px;  float: left;  margin-top: 2px;" class="btn btn-sm btn-primary"onclick="inviteList()">Invite</button>-->
                            </div>
                            <div class="col-xs-6 form-group" style="margin-top:10px;">
                                <div id="alert"></div>
                            </div>
                            <div class="col-xs-12 form-group">
                                <div id="MeetingInvitedList">
                                </div>
                            </div>
                        </form>

                        <div class="col-xs-12 form-group">
                            <button type="button" id="advanceButton" class="btn btn-sm btn-primary" onClick="">CREATE</button>
                            <button type="button" class="btn btn-sm btn-default" onclick="window.history.back()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include "include/footer.php" ?>
    </body>
<?php include "include/foot.php"; ?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<script src="js/gmap3.min.js"></script>
<script src="js/googleAddress.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/timepicker/jquery.ui.timepicker.js"></script>
<script>

$(document).ready(function () {

    $('#StartTime').timepicker({
        timeSeparator: ':',
        minutes: {
            starts: 0,                // First displayed minute
            ends: 55,                 // Last displayed minute
            interval: 15,              // Interval of displayed minutes
            manual: []                // Optional extra entries for minutes
        },
        rows: 2,
        showNowButton: false
    });
    $('#EndTime').timepicker({
        timeSeparator: ':',
        minutes: {
            starts: 0,                // First displayed minute
            ends: 55,                 // Last displayed minute
            interval: 15,              // Interval of displayed minutes
            manual: []                // Optional extra entries for minutes
        },
        rows: 2,
        showNowButton: false
    });

    $("#createdby").val(localStorage.getItem("memberId"));

    initialize();//Google Address Initilization

    $("#StartDate").datepicker({
        dateFormat: "yy-mm-dd"
    });
    $("#EndDate").datepicker({
        dateFormat: "yy-mm-dd"
    });


    $("#StartDate,#EndDate").datepicker({
        dateFormat: "yy-mm-dd"
    }).change(function () {
            var sdate = $('#StartDate').datepicker("getDate");
            var edate = $('#EndDate').datepicker("getDate");
            if (this.id == 'StartDate') {
                if (sdate > edate) {
                    $('#EndDate').datepicker("setDate", sdate);
                }
            } else {
                if (edate < sdate) {
                    $('#StartDate').datepicker("setDate", edate);
                }
            }
        });

    $("#StartTime,#EndTime").change(function () {

            var sdate = $('#StartTime').timepicker("getTime");
            var edate = $('#EndTime').timepicker("getTime");
            if (this.id == 'StartTime') {
                if (sdate > edate) {
                    $('#EndTime').timepicker("setTime", sdate);
                }
            } else {
                if (edate < sdate) {
                    $('#StartTime').timepicker("setTime", edate);
                }
            }
        });

    $("#fullday").change(function () {
        if (this.checked) {
            $("#timeAllocation").hide();
            $("#timeAllocation input").val("");
        }
        else {
            $("#timeAllocation").show();
        }
    });

    $("#addLocation").change(function () {
        if (this.checked) {
            $("#locationAllocation").show();
        }
        else {
            $("#locationAllocation").hide();
            $("#locationAllocation input").val("");
        }
    });

    $("#repeat").change(function () {
        if (this.checked) {
            $("#repeatAllocation").show();
        }
        else {
            $("#repeatAllocation").hide();
        }
    });


    //new
    if(localStorage.getItem("advanceID")==0){
        $("#advanceButton").attr("onclick","javascript: saveAdvanceEvent('frmMeeting')");
        $("#Subject").val(localStorage.getItem("tempSubject"));
        $("textarea#Description").val(localStorage.getItem("tempDescription"));
        var tempDate = localStorage.getItem("tempClickedDate");
        $('#StartDate').datepicker("setDate", new Date(dateFormat(new Date(tempDate),'y'),dateFormat(new Date(tempDate),'m')-1,dateFormat(new Date(tempDate),'d')) );
        $('#EndDate').datepicker("setDate", new Date(dateFormat(new Date(tempDate),'y'),dateFormat(new Date(tempDate),'m')-1,dateFormat(new Date(tempDate),'d')) );
        $('#Type').on('change', function (e) {
            var valueSelected = this.value;
            $("#notetype").val(valueSelected);
        });
        loadMap(6.929537,79.866271);
    }
    else{//update
        $("#Type").prop("disabled", true);
        $("#advanceButton").attr("onclick","javascript: updateAdvanceEvent('frmMeeting')");

        $.ajax({
            url:"process/index.php?route=event&method=getAdvanceEventData",
            type: "post",
            dataType: 'json',
            async:false,
            data:"id="+localStorage.getItem("advanceID"),
            success: function (e) {
                var data = e;
                data = JSON.parse(data.success);
                data = data[0];

                $('#Type').val(data.notetype);
                $('#Subject').val(data.subject);
                if(data.location=="0"){
                    $('#addLocation').prop('checked', false);
                    $("#locationAllocation").hide();
                    $("#locationId").val("0");
                }
                else
                {
                    $('#addLocation').prop('checked', true);
                    $("#locationAllocation").show();
                    $("#locationId").val(data.locationid);
                }

                if(data.timeslotid=="0"){
                    $('#fullday').prop('checked', true);
                    $("#timeAllocation").hide();
                }
                else
                {
                    $('#fullday').prop('checked', false);
                    $("#timeAllocation").show();
                }

                if(data.repeat==""){
                    $('#repeat').prop('checked', false);
                    $("#repeatAllocation").hide();
                    $("#repeatId").val("");
                }
                else
                {
                    $('#repeat').prop('checked', true);
                    $("#repeatAllocation").show();
                    $("#repeatId").val(data.repeat);
                }

                $('#StartDate').datepicker("setDate", new Date(dateFormat(new Date(data.startdate),'y'),dateFormat(new Date(data.startdate),'m')-1,dateFormat(new Date(data.startdate),'d')) );
                $('#EndDate').datepicker("setDate", new Date(dateFormat(new Date(data.enddate),'y'),dateFormat(new Date(data.enddate),'m')-1,dateFormat(new Date(data.enddate),'d')) );
                $("textarea#Description").val(data.description);


                $('#street').val(data.street);
                $('#city').val(data.city);
                $('#state').val(data.state);
                $('#country').val(data.country);

                $('#longitude').val(data.longitude);
                $('#latitude').val(data.latitude);

                $('#StartTime').val(data.starttime);
                $('#EndTime').val(data.endtime);

                loadMap(data.latitude,data.longitude);
                loadInvitee();
            }
        });

    }
});

function loadInvitee(){
    $.ajax({
        url: "process/index.php?route=event&method=getinvitebynoteid",
        type: "post",
        dataType: 'json',
        data: "noteid="+localStorage.getItem("advanceID"), // provided this code executes in form.onsubmit event
        success: function (e) {
            var data = e;
            data = JSON.parse(data.success);

            $("#MeetingInvitedList").html('');

            $.each( data, function( key, value ) {
                var Email = value.email;
                var fullEmail = Email;
                Email = Email.split("@");
                $("#MeetingInvitedList").append($('<div data-status="'+value.status+'" class="tags mtags ' + Email[0] + 'MList" >' + fullEmail + ' <a class="" onclick="removeMFromInvitedList(' + "'" + Email[0] + "'" + ')">x</a></div>'));
            });


        },
        failure: function () {

        }
    });
}

function showalertMeeting(message, alerttype) {

    $('#alert').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">×</a><span>' + message + '</span></div>')

    setTimeout(function () { // this will automatically close the alert and remove this if the users doesnt close it in 5 secs

        $("#alertdiv").remove();

    }, 3000);
}

function addToInvitedList() {
    debugger;
    var Email = $("#MeetingInviteeEmail").val();

    var data =checkEmailListForMeeting(Email);
    if(data==true)
    {
        var fullEmail = Email;
        Email = Email.split("@");
        $("#MeetingInvitedList").append($('<div class="tags mtags ' + Email[0] + 'MList" >' + fullEmail + '<a class="" onclick="removeMFromInvitedList(' + "'" + Email[0] + "'" + ')">x</a></div>'));
        $("#MeetingInviteeEmail").val("")
    }
    else
    {
        showalertMeeting("Email Not Valid Or Not Registered With System.", "alert-danger");

    }
}
function checkEmailListForMeeting(email){
    if(validateEmail(email)){
        r= false;
        $.ajax({
            url : "process/?route=user&method=checkEmail" ,
            async: false,
            data : {email : email},
            type :'post',
            success : function(e){
                r = e == 0 ? false : true ;
            },
            failure : function(){
                console.log('error');
            }
        });
        return r ;
    }else
        return false;

}
function removeMFromInvitedList(id) {

    var email = [] ;
    var removedTag = $("." + id+"MList");
    var str = $( removedTag ).text();
    str = str.split("x");
    email.push({
        "noteid" : localStorage.getItem("advanceID"),
        "memberemail" : str[0],
        "status" : $( removedTag ).data('status') });

    $.ajax({
        url: "process/index.php?route=event&method=deleteinviteMembers",
        type: "post",
        dataType: 'json',
        data: { deleteinvite : email}, // provided this code executes in form.onsubmit event
        success: function (output) {
            if(output.success=="success"){
                showalertMeeting("Invite Revoked.", "alert-success");
                $("." + id+"MList").remove();
            }
        },
        failure: function () {

        }
    });

}


</script>
</html>
