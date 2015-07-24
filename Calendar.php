<?php include "include/head.php"; ?>
    <body>

        <?php include 'include/header.php'; ?>

        <section class="main" >
            <div class="content" >
                <div class="container" >
                    <div class="block-header">
                        <h2>&nbsp;</h2>
                        <h2>&nbsp;</h2>
                        <h2>&nbsp;</h2>
                        <h2>&nbsp;</h2>
                    </div>
                    <div id="calender"></div>
                </div>
            </div>
        </section>

        <footer id="footer" >
            <center>
                <img class="" src="img/ch_logo.png" alt="Code Hunters Logo" style="padding: 20px;height: 100px;">
                <span style="color: #fff;font-size:15px;font-weight: 100;">&copy; 2015 Code Hunters. All Rights Reserved.</span>
            </center>
        </footer>

        <div id="CommonModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="ClickedDate"></h4>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#eventTab" role="tab" data-toggle="tab">Note</a></li>
                            <li><a href="#birthdayTab" role="tab" data-toggle="tab">Birthday / Anniversary</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="eventTab">
                                <form role="form" id="eventForm">
                                    <input type=hidden class="createdby" name="createdby" value="">
                                    <input type=hidden name=timeslotid value="0">
                                    <input type=hidden name=status value="1">
                                    <input type=hidden class="ClickedDate" name=startdate value="">
                                    <input type=hidden class="ClickedDate" name=enddate value="">
                                    <input type=hidden class="CurrentDate" name=createddate value="">
                                    <input type=hidden name=notetype value="2">
                                    <input type=hidden name=location value="0">
                                    <div class= "col-xs-12 form-group">
                                        <input type="text" class="form-control" name="subject" id="Subject" placeholder="Subject"/>
                                    </div>
                                    <div class= "col-xs-12 form-group">
                                        <textarea class="form-control custom-control" placeholder="Description" name="description" id="description" rows="5" style="resize:none"></textarea>
                                    </div>
                                    <a style="cursor: pointer" id="advance-view-note" >Advance Options</a>
                                </form>
                                <div class="pull-right">
                                    <button type="button" class="btn btn-sm btn-primary" id="eventButton" onclick="saveBasicEvent('eventForm')">Save</button>
                                    <button type="button" style="display:none" class="btn btn-sm btn-danger" id="eventButtonDelete" onclick="">Delete</button>
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <div class="tab-pane" id="birthdayTab">
                                <form role="form" id="birthdayForm">
                                    <input type=hidden class="createdby" name="createdby" value="">
                                    <input type=hidden name=timeslotid value="0">
                                    <input type=hidden name=status value="1">
                                    <input type=hidden class="ClickedDate" name=startdate value="">
                                    <input type=hidden class="ClickedDate" name=enddate value="">
                                    <input type=hidden class="CurrentDate" name=createddate value="">
                                    <input type=hidden name=notetype value="3">
                                    <input type=hidden name=location value="0">
                                    <div class= "col-xs-12 form-group">
                                        <input type="text" class="form-control" id="BirthDayName" name="subject" placeholder="Name"/>
                                    </div>
                                    <div class= "col-xs-12 form-group">
                                        <input type="text" style="  width: 10%;  float: left;" class="form-control" id="Bdate" placeholder="Date"/>
                                        <input type="text" style="  width: 10%;  float: left;" class="form-control" id="Bmonth" placeholder="Month"/>
                                        <input type="text" style="  width: 10%;  float: left;" class="form-control" id="Byear" placeholder="Year"/>
                                    </div>
                                </form>
                                <div class="pull-right">
                                    <button type="button" class="btn btn-sm btn-primary" id="birthdayButton" onclick="saveBasicEvent('birthdayForm')">Save</button>
                                    <button type="button" style="display:none" class="btn btn-sm btn-danger" id="birthdayButtonDelete" onclick="">Delete</button>
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>



        <div id="share" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: rgb(116, 186, 207);">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" > Share </h4>
                    </div>
                    <div class="modal-body">
                        <div class= "col-xs-6 form-group">
                            <input type="text" style="  width: 50%;  float: left;" class="form-control"  id="shareEmail" placeholder="share Email"/><button type="button" style="  margin-left: 10px;  float: left;  margin-top: 2px;" class="btn btn-sm btn-primary"onclick="addToShareList()">Add to List</button>
                        </div>
                        <div class= "col-xs-12 form-group">
                            <form id="shareList" >
                            <form>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn btn-sm btn-primary" id="share_from" onclick="">Share</button>
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>







    </body>

    <?php include "include/foot.php" ?>

<script type="text/javascript" >

    var app = new calendar({
        id : 'calender',
        view : 'month'
    });


    $( document ).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $(".createdby").val(localStorage.getItem("memberId"));
    });



    function addToInvitedList() {
        var Email = $("#InviteeEmail").val();
        if(validateEmail( Email )){
            var fullEmail = Email;
            Email = Email.split("@");
            $("#ShareCalenderList").append($('<div data-status="0" class="tags ' + Email[0] + 'List" >' + fullEmail + '<a class="" onclick="removeFromInvitedList(' + "'" + Email[0] + "'" + ')">x</a></div>'));
            $("#InviteeEmail").val("");
        }
    }

    function addToShareList() {
        var Email = $("#shareEmail").val();
        if(validateEmail( Email )){
            $('<div class="tags " >' +
                '<input type="hidden" name="email[]" value="'+Email+'" >' + Email +
                '<i class="glyphicon glyphicon-remove remove pull-right" ></i>' +
                '</div> ').appendTo('#shareList');
            $("#shareEmail").val("");
        }
    }

    $('body').on('click','.remove',function(){
        $(this).closest('.tags').remove();
    }).click(function(e){
            if( !$("#min_cal").hasClass('hidden'))  $("#min_cal").addClass('hidden');
        });

    function removeFromInvitedList(id) {
        debugger;
        var email = [] ;
        var removedTag = $("." + id+"List");
        var str = $( removedTag ).text();
        str = str.split("x");
        email.push({
            "memberid" : localStorage.getItem("memberId"),
            "sharedmemberemail" : str[0],
            "status" : $( removedTag ).data('status') });

        $.ajax({
            url: "process/index.php?route=event&method=deleteSharedCalendar",
            type: "post",
            dataType: 'json',
            data: { sharedMembersList : email}, // provided this code executes in form.onsubmit event
            success: function (output) {
                if(output.success=="success"){
                    showalert("Shared Calender Revoked.", "alert-success", "", "");
                    $("." + id+"List").remove();
                }
            },
            failure: function () {
            }
        });

    }

</script>

</html>
