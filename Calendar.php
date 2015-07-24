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

        <div id="CommonViewModal" class="modal fade">
            <style>
                .form-control
                {
                    padding: 6px 12px;
                }
            </style>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="viewHead" ></h4>
                    </div>
                    <div class="modal-body">
                        <div style="display: none" id="birthdayedit">
                            <div class= "col-xs-12 form-group">
                                <input type="text" class="form-control" id="EBirthDayName" name="subject" placeholder="Name" readonly/>
                            </div>
                            <div class= "col-xs-12 form-group">
                                <input type="text" style="width: 10%;float: left;" class="form-control" id="EBdate" placeholder="Date" readonly/>
                                <input type="text" style="width: 10%;float: left;" class="form-control" id="EBmonth" placeholder="Month" readonly/>
                                <input type="text" style="width: 10%;float: left;" class="form-control" id="EByear" placeholder="Year" readonly/>
                            </div>
                        </div>
                        <div class= "col-xs-12 form-group">
                            <label type="text" class="form-control" style="display:none" id="ViewSubject"> </label>
                        </div>
                        <div class= "col-xs-12 form-group">
                            <label class="form-control custom-control" style="display:none" id="ViewDescription"></label>
                        </div>
                        <div class= "col-xs-6 form-group">
                            <label class="form-control custom-control" style="display:none" id="ViewStartDate"></label>
                        </div>
                        <div class= "col-xs-6 form-group">
                            <label class="form-control custom-control" style="display:none" id="ViewEndDate"></label>
                        </div>
                        <div class= "col-xs-6 form-group">
                            <label class="form-control custom-control" style="display:none" id="ViewStartTime"></label>
                        </div>
                        <div class= "col-xs-6 form-group">
                            <label class="form-control custom-control" style="display:none" id="ViewEndTime"></label>
                        </div>
                        <div class= "col-xs-12 form-group">
                            <label class="form-control custom-control" style="display:none" id="ViewLocation"></label>
                        </div>
                        <div class= "col-xs-12 form-group" id="ViewInviteList" style="display:none">

                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn btn-sm btn-primary" id="editButton" onclick="">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger" id="viewButtonDelete" onclick="">Delete</button>
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>

        <div id="share" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
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

        <div id="ShareModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="" >Share My Calender</h4>
                    </div>
                    <div class="modal-body">
                        <div class= "col-xs-6 form-group">
                            <input type="text" style="  width: 50%;  float: left;" class="form-control"  id="InviteeEmail" placeholder="InviteeEmail"/><button type="button" style="  margin-left: 10px;  float: left;  margin-top: 2px;" class="btn btn-sm btn-primary"onclick="addToInvitedList()">Add to List</button>
                        </div>
                        <div class= "col-xs-12 form-group">
                            <div id="InvitedList">
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn btn-sm btn-primary" id="shareCalenderButton" onclick="">Share/Update</button>
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>

        <div id="ViewShareModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="" >Calendars Shared With Me</h4>
                    </div>
                    <div class="modal-body">
                        <div id="sharedList"></div>
                        <div class="pull-right">
                            <button type="button" class="btn btn-sm btn-primary" onclick="drawSharedCalender()">View</button>
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>

        <div id="ConfigureModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="" >Configure Calendar</h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div>
                                <label>Birth Day</label>
                                <select id="Color_Type_BirthDay">
                                    <option value="bgm-brown" class="bgm-brown"></option>
                                    <option value="bgm-pink" class="bgm-pink"></option>
                                    <option value="bgm-red" class="bgm-red"></option>
                                    <option value="bgm-blue" class="bgm-blue"></option>
                                    <option value="bgm-purple" class="bgm-purple"></option>
                                    <option value="bgm-lightblue" class="bgm-lightblue"></option>
                                    <option value="bgm-cyan" class="bgm-cyan"></option>
                                    <option value="bgm-teal" class="bgm-teal"></option>
                                    <option value="bgm-green" class="bgm-green"></option>
                                    <option value="bgm-yellow" class="bgm-yellow"></option>
                                    <option value="bgm-amber" class="bgm-amber"></option>
                                    <option value="bgm-orange" class="bgm-orange"></option>
                                    <option value="bgm-deeporange" class="bgm-deeporange"></option>
                                    <option value="bgm-gray" class="bgm-gray"></option>
                                    <option value="bgm-bluegray" class="bgm-bluegray"></option>
                                    <option value="bgm-indigo" class="bgm-indigo"></option>
                                </select>
                            </div>
                            <div>
                                <label>Note</label>
                                <select id="Color_Type_Note">
                                    <option value="bgm-brown" class="bgm-brown"></option>
                                    <option value="bgm-pink" class="bgm-pink"></option>
                                    <option value="bgm-red" class="bgm-red"></option>
                                    <option value="bgm-blue" class="bgm-blue"></option>
                                    <option value="bgm-purple" class="bgm-purple"></option>
                                    <option value="bgm-lightblue" class="bgm-lightblue"></option>
                                    <option value="bgm-cyan" class="bgm-cyan"></option>
                                    <option value="bgm-teal" class="bgm-teal"></option>
                                    <option value="bgm-green" class="bgm-green"></option>
                                    <option value="bgm-yellow" class="bgm-yellow"></option>
                                    <option value="bgm-amber" class="bgm-amber"></option>
                                    <option value="bgm-orange" class="bgm-orange"></option>
                                    <option value="bgm-deeporange" class="bgm-deeporange"></option>
                                    <option value="bgm-gray" class="bgm-gray"></option>
                                    <option value="bgm-bluegray" class="bgm-bluegray"></option>
                                    <option value="bgm-indigo" class="bgm-indigo"></option>
                                </select>
                            </div>
                            <div>
                                <label>Meeting</label>
                                <select id="Color_Type_Meeting">
                                    <option value="bgm-brown" class="bgm-brown"></option>
                                    <option value="bgm-pink" class="bgm-pink"></option>
                                    <option value="bgm-red" class="bgm-red"></option>
                                    <option value="bgm-blue" class="bgm-blue"></option>
                                    <option value="bgm-purple" class="bgm-purple"></option>
                                    <option value="bgm-lightblue" class="bgm-lightblue"></option>
                                    <option value="bgm-cyan" class="bgm-cyan"></option>
                                    <option value="bgm-teal" class="bgm-teal"></option>
                                    <option value="bgm-green" class="bgm-green"></option>
                                    <option value="bgm-yellow" class="bgm-yellow"></option>
                                    <option value="bgm-amber" class="bgm-amber"></option>
                                    <option value="bgm-orange" class="bgm-orange"></option>
                                    <option value="bgm-deeporange" class="bgm-deeporange"></option>
                                    <option value="bgm-gray" class="bgm-gray"></option>
                                    <option value="bgm-bluegray" class="bgm-bluegray"></option>
                                    <option value="bgm-indigo" class="bgm-indigo"></option>
                                </select>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn btn-sm btn-primary" onclick="saveConfigureCalendar()">View</button>
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript" src="js/jquery.js" ></script>
    <script type="text/javascript" src="js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="js/bootbox.js" ></script>
    <script type="text/javascript" src="js/jquery-ui.custom.min.js" ></script>
    <script type="text/javascript" src="js/calendar/main.js?v=1.1" ></script>
    <script type="text/javascript" src="js/calendar/view/monthView.js?v=1.1" ></script>
    <script type="text/javascript" src="js/calendar/view/weekView.js?v=1.1" ></script>
    <script type="text/javascript" src="js/calendar/view/dayView.js?v=1.1" ></script>
    <script type="text/javascript" src="js/calendar/view/birthdayView.js?v=1.1" ></script>
    <script type="text/javascript" src="js/common.js?" ></script>

    <script src="js/sweet-alert.js"></script>
    <link rel="stylesheet" type="text/css" href="css/sweet-alert.css">

    <script type="text/javascript" >

        var app = new calendar({
            id : 'calender',
            view : 'month'
        });
        var app1 = new calendar({
            id : 'min_cal',
            view : 'month',
            min : true
        });
        $(".min-calendar").click(function(){
            $("#min_cal").toggleClass('hidden');
        });

        $(document).ready(function () {

            $('[data-toggle="tooltip"]').tooltip();

            $(".createdby").val(localStorage.getItem("memberId"));
            loadShareCalenderList(localStorage.getItem("memberId"));
            loadSharedCalenderList(localStorage.getItem("memberId"));
            //loadConfigureModelDetails(localStorage.getItem("memberId"));
            $("#shareCalenderButton").attr("onclick","ShareCalenderList('"+localStorage.getItem("memberId")+"')");

            $(".viewshareCal").click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                debugger;
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
                window.location.href="/Online-Calender/savepdf.html";
                return false;
            } );

            $(".configure").click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('#ConfigureModal').modal('show');
                return false;
            } );
        });

        function addToInvitedList() {
            var Email = $("#InviteeEmail").val();
            if(validateEmail( Email )){
                var fullEmail = Email;
                Email = Email.split("@");
                $("#InvitedList").append($('<div data-status="0" class="tags ' + Email[0] + 'List" >' + fullEmail + '<a class="" onclick="removeFromInvitedList(' + "'" + Email[0] + "'" + ')">x</a></div>'));
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

    <script type="text/javascript" src="js/functions.js" ></script>

</html>
