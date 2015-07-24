<header id="header">
    <ul class="header-inner">
        <li class="logo">
            <a href="/">CODE HUNTERS</a>
        </li>
        <li style="margin-left: 20%;position: relative">
            <input class="visible-lg visible-md " type="text" id="txtSearch">
            <div class="search_result hidden"  ></div>
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
            <a class="pull-right" ><?=$user['name']?></a>
        </li>
    </ul>
</header>
