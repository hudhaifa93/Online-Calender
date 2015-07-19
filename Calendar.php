<?php $user = session::get('user'); ?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>Code Hunters - Calender</title>
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
        </style>
    </head>
    <body>
        <header id="header">
            <ul class="header-inner">
                <li class="logo">
                    <a href="Calendar.html">CODE HUNTERS</a>
                </li>
                <li class="pull-right">
                    <ul class="top-menu">
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="tm-message" href=""><i class="tmn-counts">6</i></a>
                            <div class="dropdown-menu dropdown-menu-lg pull-right">
                                <div class="listview">
                                    <div class="lv-header">Messages</div>
                                    <div class="lv-body c-overflow" tabindex="1" style="overflow: hidden; outline: none;">
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="img/profile-pics/1.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">David Belle</div>
                                                    <small class="lv-small">Cum sociis natoque penatibus et magnis dis parturient montes</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="img/profile-pics/2.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Jonathan Morris</div>
                                                    <small class="lv-small">Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="img/profile-pics/3.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Fredric Mitchell Jr.</div>
                                                    <small class="lv-small">Phasellus a ante et est ornare accumsan at vel magnauis blandit
                                                        turpis at augue ultricies
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="img/profile-pics/4.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Glenn Jecobs</div>
                                                    <small class="lv-small">Ut vitae lacus sem ellentesque maximus, nunc sit amet varius
                                                        dignissim, dui est consectetur neque
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="img/profile-pics/4.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Bill Phillips</div>
                                                    <small class="lv-small">Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet
                                                        vel ante placerat
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
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
<!--                            <div class="tab-pane" id="MeetingTab">-->
<!--                                <form role="form" id="meetingForm">-->
<!--                                    <input type=hidden class="createdby" name="createdby" value="">-->
<!--                                    <input type=hidden name=timeslotid value="0">-->
<!--                                    <input type=hidden name=status value="1">-->
<!--                                    <input type=hidden class="ClickedDate" name=startdate value="">-->
<!--                                    <input type=hidden class="ClickedDate" name=enddate value="">-->
<!--                                    <input type=hidden class="CurrentDate" name=createddate value="">-->
<!--                                    <input type=hidden name=notetype value="1">-->
<!--                                    <input type=hidden name=location value="0">-->
<!--                                    <div class= "col-xs-12 form-group">-->
<!--                                        <input type="text" class="form-control" name="subject" id="MeetingName" placeholder="Meeting Name"/>-->
<!--                                    </div>-->
<!--                                    <div class= "col-xs-12 form-group">-->
<!--                                        <textarea class="form-control custom-control" placeholder="Description" name="description" id="MeetingDescription" rows="5" style="resize:none"></textarea>-->
<!--                                    </div>-->
<!--                                    <a style="cursor: pointer" id="advance-view-meeting" >Advance Options</a>-->
<!--                                </form>-->
<!--                                <div class="pull-right">-->
<!--                                    <button type="button" class="btn btn-sm btn-primary" id="meetingButton" onclick="saveBasicEvent('meetingForm')">Save</button>-->
<!--                                    <button type="button" style="display:none" class="btn btn-sm btn-danger" id="meetingButtonDelete" onclick="">Delete</button>-->
<!--                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>-->
<!--                                </div>-->
<!--                            </div>-->
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
    </body>

    <script type="text/javascript" src="js/jquery.js" ></script>
    <script type="text/javascript" src="js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="js/jquery-ui.custom.min.js" ></script>
    <script type="text/javascript" src="js/calendar/main.js?v=1.1" ></script>
    <script type="text/javascript" src="js/calendar/view/monthView.js?v=1.1" ></script>
    <script type="text/javascript" src="js/calendar/view/weekView.js?v=1.1" ></script>
    <script type="text/javascript" src="js/calendar/view/dayView.js?v=1.1" ></script>
    <script type="text/javascript" src="js/common.js?" ></script>
    <script type="text/javascript" >

        var app = new calendar({
            id : 'calender',
            view : 'month'
        });

        $(document).ready(function () {
            $(".createdby").val(localStorage.getItem("memberId"));
        });

    </script>

    <script type="text/javascript" src="js/functions.js" ></script>

</html>