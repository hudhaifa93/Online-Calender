<header id="header">
    <ul class="header-inner">
        <li class="logo">
            <a href="/">CODE HUNTERS</a>
        </li>
        <li style="margin-left: 20%;position: relative">
            <input class="visible-lg visible-md " type="text" id="txtSearch">
            <div class="search_result hidden"  ></div>
        </li>
        <li>
            <div class=" glyphicon glyphicon-calendar pull-right min-calendar" style="color: #ffffff;font-size: 30px;margin: 5px;cursor:pointer" ></div>
            <div class="clearfix" ></div>
            <div id="min_cal" class="hidden"style="position: absolute;z-index: 99999" ></div>
        </li>
        <li class="pull-right">
            <ul class="top-menu">

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
                                <a class="lv-item export" href="">
                                    <div class="media">
                                        <div class="pull-left">
                                            <i class="glyphicon glyphicon-log-out " style="color: #f44336" ></i>
                                        </div>
                                        <div class="media-body">
                                            <small class="lv-small">Export To PDF</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="lv-item configure" href="">
                                    <div class="media">
                                        <div class="pull-left">
                                            <i class="glyphicon glyphicon-log-out " style="color: #f44336" ></i>
                                        </div>
                                        <div class="media-body">
                                            <small class="lv-small">Configure</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="lv-item logout" href="">
                                    <div class="media">
                                        <div class="pull-left">
                                            <i class="glyphicon glyphicon-log-out " style="color: #f44336" ></i>
                                        </div>
                                        <div class="media-body">
                                            <small class="lv-small">Logout</small>
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
            <div class=" pull-left circleBase type1 " id="profile-logo" >
                <?php
                $name= explode(" ",$user['name']);
                echo substr(strtoupper($name[0]),0,1)."<small>".substr(strtolower(end($name)),0,1)."</small>"?>
            </div>
            <a class="pull-right" ><?= strlen($user['name'])> 20 ? $name[0].".." : $user['name'] ?></a>
        </li>
    </ul>
</header>
<!--common-->
<div id="CommonViewModal" class="modal fade">
    <style>
        .form-control
        {
            padding: 6px 12px;
        }
    </style>
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="Common_View_Model">
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
<!--common-->
<div id="ShareModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(116, 186, 207);">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="" >Share My Calender</h4>
            </div>
            <div class="modal-body">
                <div class= "col-xs-6 form-group">
                    <input type="text" style="  width: 50%;  float: left;" class="form-control"  id="InviteeEmail" placeholder="InviteeEmail"/><button type="button" style="  margin-left: 10px;  float: left;  margin-top: 2px;" class="btn btn-sm btn-primary"onclick="addToInvitedList()">Add to List</button>
                </div>
                <div class= "col-xs-12 form-group">
                    <div id="ShareCalenderList">
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
<!--common-->
<div id="ViewShareModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(116, 186, 207);">
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
<!--common-->
<div id="ConfigureModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(116, 186, 207);">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="" >Configure Calendar</h4>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td style="padding:5px;">
                            <label>Birth Day</label>
                        </td>
                        <td style="padding:5px;">
                            <select id="Color_Type_BirthDay" class="color_type" style="width: 50px;">
                                <option value="bgm-brown" class="bgm-brown"></option>
                                <option value="bgm-purple" class="bgm-purple"></option>
                                <option value="bgm-pink" class="bgm-pink"></option>
                                <option value="bgm-red" class="bgm-red"></option>
                                <option value="bgm-deeporange" class="bgm-deeporange"></option>
                                <option value="bgm-orange" class="bgm-orange"></option>
                                <option value="bgm-amber" class="bgm-amber"></option>
                                <option value="bgm-yellow" class="bgm-yellow"></option>
                                <option value="bgm-green" class="bgm-green"></option>
                                <option value="bgm-teal" class="bgm-teal"></option>
                                <option value="bgm-cyan" class="bgm-cyan"></option>
                                <option value="bgm-blue" class="bgm-blue"></option>
                                <option value="bgm-indigo" class="bgm-indigo"></option>
                                <option value="bgm-lightblue" class="bgm-lightblue"></option>
                                <option value="bgm-gray" class="bgm-gray"></option>
                                <option value="bgm-bluegray" class="bgm-bluegray"></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:5px;">
                            <label>Note</label>
                        </td>
                        <td style="padding:5px;">
                            <select id="Color_Type_Note" class="color_type" style="width: 50px;">
                                <option value="bgm-brown" class="bgm-brown"></option>
                                <option value="bgm-purple" class="bgm-purple"></option>
                                <option value="bgm-pink" class="bgm-pink"></option>
                                <option value="bgm-red" class="bgm-red"></option>
                                <option value="bgm-deeporange" class="bgm-deeporange"></option>
                                <option value="bgm-orange" class="bgm-orange"></option>
                                <option value="bgm-amber" class="bgm-amber"></option>
                                <option value="bgm-yellow" class="bgm-yellow"></option>
                                <option value="bgm-green" class="bgm-green"></option>
                                <option value="bgm-teal" class="bgm-teal"></option>
                                <option value="bgm-cyan" class="bgm-cyan"></option>
                                <option value="bgm-blue" class="bgm-blue"></option>
                                <option value="bgm-indigo" class="bgm-indigo"></option>
                                <option value="bgm-lightblue" class="bgm-lightblue"></option>
                                <option value="bgm-gray" class="bgm-gray"></option>
                                <option value="bgm-bluegray" class="bgm-bluegray"></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:5px;">
                            <label>Meeting</label>
                        </td>
                        <td style="padding:5px;">
                            <select id="Color_Type_Meeting" class="color_type" style="width: 50px;">
                                <option value="bgm-brown" class="bgm-brown"></option>
                                <option value="bgm-purple" class="bgm-purple"></option>
                                <option value="bgm-pink" class="bgm-pink"></option>
                                <option value="bgm-red" class="bgm-red"></option>
                                <option value="bgm-deeporange" class="bgm-deeporange"></option>
                                <option value="bgm-orange" class="bgm-orange"></option>
                                <option value="bgm-amber" class="bgm-amber"></option>
                                <option value="bgm-yellow" class="bgm-yellow"></option>
                                <option value="bgm-green" class="bgm-green"></option>
                                <option value="bgm-teal" class="bgm-teal"></option>
                                <option value="bgm-cyan" class="bgm-cyan"></option>
                                <option value="bgm-blue" class="bgm-blue"></option>
                                <option value="bgm-indigo" class="bgm-indigo"></option>
                                <option value="bgm-lightblue" class="bgm-lightblue"></option>
                                <option value="bgm-gray" class="bgm-gray"></option>
                                <option value="bgm-bluegray" class="bgm-bluegray"></option>
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="pull-right">
                    <button type="button" class="btn btn-sm btn-primary" onclick="saveConfigureCalendar()">Save</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>