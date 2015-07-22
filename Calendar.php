<?php $user = session::get('user'); ?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>Code Hunters - Calendar</title>
        <link rel="stylesheet" href="css/fullcalendar.min.css"/>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/app.min.1.css"/>
        <link rel="stylesheet" href="css/app.min.2.css"/>
        <link rel="stylesheet" href="css/socicon.min.css"/>
        <style>
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

            .tags {
                float: left;
                margin-right: 2px;
                margin-bottom: 7px;
                margin-top: 1px;
                height: 22px;
                border-radius: 4px;
                border: 1px solid #cccccc;
                font: normal 14px/20px 'Sanchez';
                background: #ebeaea;
                background: -o-linear-gradient(top, #C4CDE0, #C4CDE0);
                background: -webkit-linear-gradient(top, #C4CDE0, #C4CDE0);
                background: -moz-linear-gradient(top, #C4CDE0, #C4CDE0);
                background: -ms-linear-gradient(top, #C4CDE0, #C4CDE0);
                background: linear-gradient(top, #C4CDE0, #C4CDE0);
                filter: progid:DXImageTransform.Microsoft.Gradient(startColorStr="#C4CDE0", endColorStr="#C4CDE0");
                border-color: #cccccc;
                cursor: pointer;
                box-shadow: inset 0 2px 0 rgba(255, 255, 255, 0.3);
                padding-left: 6px;
                padding-right: 28px;
                position: relative;
            }
            .tags .delete {
                display: block;
                width: 20px;
                height: 20px;
                float: right;
                background: url('../Content/images/panel_tools.png') no-repeat -16px 0px;
                margin-left: 6px;
                border-left: 1px solid #ccc;
                position: absolute;
                top: 0;
                right: 0;
            }
            #footer{
                background: #B81A0E;
                box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.3);
                height: 100px;
                z-index: 10;
                width: 100%;
                left: 0;
                padding-right: 10px;
            }

        </style>
    </head>
    <body>
        <header id="header">
            <ul class="header-inner">
                <li class="logo">
                    <a href="/">CODE HUNTERS</a>
                </li>
                <li style="margin-left: 15.333333%;">
                    <input type="text" id="txtSearch">
                </li>
                <li class="pull-right">
                    <ul class="top-menu">
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="tm-message" href=""></a>
                            <div class="dropdown-menu dropdown-menu-lg pull-right">
                                <div class="listview">
                                    <div class="lv-header">Messages</div>
                                    <div class="lv-body c-overflow" tabindex="1" style="overflow: hidden; outline: none;">

                                    </div>
                                    <a class="lv-footer" href="">View All</a>
                                </div>
                                <div id="ascrail2002" class="nicescroll-rails nicescroll-rails-vr"
                                     style="width: 0px; z-index: 9; cursor: default; position: absolute; top: 0px; left: 298px; height: 275px; display: none;">
                                    <div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 0px; height: 0px; border: 0px; border-radius: 0px; background-color: rgba(0, 0, 0, 0.498039); background-clip: padding-box;"></div>
                                </div>
                                <div id="ascrail2002-hr" class="nicescroll-rails nicescroll-rails-hr"
                                     style="height: 0px; z-index: 9; top: 275px; left: 0px; position: absolute; cursor: default; display: none;">
                                    <div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 0px; width: 0px; border: 0px; border-radius: 0px; background-color: rgba(0, 0, 0, 0.498039); background-clip: padding-box;"></div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="tm-notification" href=""></a>
                            <div class="dropdown-menu dropdown-menu-lg pull-right">
                                <div class="listview" id="notifications">
                                    <div class="lv-header">Notification
                                        <ul class="actions">
                                            <li class="dropdown">
                                                <a href="" data-clear="notification">
                                                    <i class="md md-done-all"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="lv-body c-overflow" tabindex="2" style="overflow: hidden; outline: none;"></div>
                                    <a class="lv-footer" href="">View Previous</a>
                                </div>
                                <div id="ascrail2003" class="nicescroll-rails nicescroll-rails-vr"
                                     style="width: 0px; z-index: 9; cursor: default; position: absolute; top: 0px; left: 298px; height: 275px; display: none;">
                                    <div class="nicescroll-cursors"
                                         style="position: relative; top: 0px; float: right; width: 0px; height: 0px; border: 0px; border-radius: 0px; background-color: rgba(0, 0, 0, 0.498039); background-clip: padding-box;"></div>
                                </div>
                                <div id="ascrail2003-hr" class="nicescroll-rails nicescroll-rails-hr"
                                     style="height: 0px; z-index: 9; top: 275px; left: 0px; position: absolute; cursor: default; display: none;">
                                    <div class="nicescroll-cursors"
                                         style="position: absolute; top: 0px; height: 0px; width: 0px; border: 0px; border-radius: 0px; background-color: rgba(0, 0, 0, 0.498039); background-clip: padding-box;"></div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="tm-task" href=""></a>
                            <div class="dropdown-menu dropdown-menu-sm pull-right">
                                <div class="listview">
                                    <div class="lv-header">Profile</div>
                                    <div class="lv-body c-overflow" tabindex="1" style="overflow: hidden; outline: none;">
                                        <a class="lv-item viewshareCal" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <i class="glyphicon glyphicon-log-out " style="color: #f44336" ></i>
                                                </div>
                                                <div class="media-body">
                                                    <small class="lv-small">My Calendars</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item shareCal" href="" >
                                            <div class="media" onclick="">
                                                <div class="pull-left">
                                                    <i class="glyphicon glyphicon-log-out " style="color: #f44336" ></i>
                                                </div>
                                                <div class="media-body">
                                                    <small class="lv-small">Share Calendar</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item logout" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <i class="glyphicon glyphicon-log-out " style="color: #f44336" ></i>
                                                </div>
                                                <div class="media-body">
                                                    <small class="lv-small">logout</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="pull-right logo" >
                        <img class="lv-img-sm img-circle pull-left img-responsive img-thumbnail " src="img/profile-pics/1.jpg" alt="">
                    <a class="pull-right" ><?=$user['name']?></a>
                </li>
            </ul>
        </header>
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
<!--                            <li><a href="#MeetingTab" role="tab" data-toggle="tab">Meeting</a></li>-->
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="viewHead" ></h4>
                    </div>
                    <div class="modal-body">
                        <div class= "col-xs-12 form-group">
                            <label type="text" class="form-control" id="ViewSubject"> </label>
                        </div>
                        <div class= "col-xs-12 form-group">
                            <label class="form-control custom-control" id="ViewDescription"></label>
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
                    <div class="modal-body" >

                    </div>
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

                        <div id="sharedList">

                        </div>

                        <div class="pull-right">
                            <button type="button" class="btn btn-sm btn-primary" onclick="drawSharedCalender()">View</button>
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
    <script type="text/javascript" >

        var app = new calendar({
            id : 'calender',
            view : 'month'
        });

        $(document).ready(function () {

            $('[data-toggle="tooltip"]').tooltip();

            $(".createdby").val(localStorage.getItem("memberId"));
            loadShareCalenderList(localStorage.getItem("memberId"));
            loadSharedCalenderList(localStorage.getItem("memberId"));
            $("#shareCalenderButton").attr("onclick","ShareCalenderList('"+localStorage.getItem("memberId")+"')");

            $(".shareCal").click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('#ShareModal').modal('show');
                return false;
            } );

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


        });

        function addToInvitedList() {
            debugger;
            var Email = $("#InviteeEmail").val();
            var fullEmail = Email;
            Email = Email.split("@");
            $("#InvitedList").append($('<div data-status="0" class="tags ' + Email[0] + 'List" >' + fullEmail + '<a class="" onclick="removeFromInvitedList(' + "'" + Email[0] + "'" + ')">x</a></div>'));
            $("#InviteeEmail").val("");
        }

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