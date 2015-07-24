var BirthDay = function (config) {
    'use strict';
    var $window = $(window);
    var self = this,
        defaults,
        _date = new Date(),
        birthdaylist,
        data = null,
        name = {
            days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            daysShort: [ "Sun" , "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ],
            daysMin: ["sun", "mon", "tue", "wed", "thu", "fri", "sat"],
            months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            buttonText: {
                prev: "<span class='ui-icon ui-icon-circle-triangle-w'></span></button>",
                next: "<span class='ui-icon ui-icon-circle-triangle-e'></span>",
                today: "today",
                month: "month",
                week: "week",
                day: "day"
            }
        };

    function getBirthDayView() {
        name.title = 'BirthDay View';
        self.id.addClass("fc fc-ltr ui-widget");
        self.id.html("");
        _head(self.id);

        $.ajax({
            url : "process/?route=Event&method=getAllBirthDaysByMemberId",
            data:  { MemberId: getMemberIds()},
            type : "post",
            dataType: "json",
            success : function(e){
                birthdaylist = e;
                _drawBirthDayView(self.id);
            }
        });
    }

    function _head(t) {

        function _left() {
            return '<div class="fc-left"></div>';
        }

        function _right() {
            return '<div class="fc-right"></div>';
        }

        function _center() {
            return  '<div class="fc-center">' +
                '<h2>' + name.title + '</h2>' +
                '</div>';
        }

        function _menu() {
            return '<ul class="actions actions-alt" id="fc-actions">' +
                '<li class="dropdown"><a href="" data-toggle="dropdown" aria-expanded="false">' +
                '<i class="md md-more-vert"></i></a>' +
                '<ul class="dropdown-menu dropdown-menu-right">' +
                '<li><a class="cal-view" data-view="month" >Month View</a></li>' +
                '<li><a class="cal-view"  data-view="week" >Week View</a></li>' +
                '<li><a class="cal-view"  data-view="day">Day View</a></li>' +
                '<li class="active"><a class="cal-view"  data-view="birthday">Birthday View</a></li>' +
                '</ul>' +
                '</li>' +
                '</ul> ';
        }

        t.append('<div class="fc-toolbar">' + _left() + _right() + _center() + _menu());
    }

    function _drawBirthDayView(t) {
        var htl = '<div class="fc-view-container" style="">' +
            '<div class="fc-view fc-agendaDay-view fc-agenda-view">' +
            '<table>' +
            '<thead>' +
            _title_bar() +
            '</thead>' +
            '<tbody>' +
            _body() +
            '</tbody>' +
            '</table>' +
            '</div>' +
            '</div>';

        function _title_bar() {
            var h = '<tr>' +
                '<td class="ui-widget-header">' +
                '<div class="fc-row ui-widget-header" style="border-right-width: 1px; margin-right: 14px;">' +
                '<table>' +
                '<thead>' +
                '<tr>' +
                '<th class="fc-axis ui-widget-header" style="width: 40px;"></th>';

            if(birthdaylist.length > 0){
                h += '<th class="fc-day-header ui-widget-header"><span style="float: left">Showing ' + birthdaylist.length  + ' Birthday(s).</span></th>';
            }else{
                h += '<th class="fc-day-header ui-widget-header"><span style="float: left">Sorry, No Birthdays Available.</span></th>';
            }

            h +='</tr>' +
                '</thead>' +
                '</table>' +
                '</div>' +
                '</td>' +
                '</tr>';

            return h;
        }

        function _body() {

            var h = '<tr>' +
                '<td class="ui-widget-content">' +
                _birthdays() +
                '<hr class="ui-widget-header">' +
                '</td>' +
                '</tr>';

            function _birthdays(){
                var h = '<div>' +
                    '<div>' +
                    '<table>' +
                    '<tbody style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif">';

                var _bday = [];
                for(var i=0;i<12;i++){ _bday.push([]);}
                if(birthdaylist.length>0){
                    for(var i=0;i<birthdaylist.length;i++){
                        var _bdate = new Date(birthdaylist[i].startdate);
                        _bday[_bdate.getMonth()].push(birthdaylist[i]);
                    }
                }

                var b = '';
                var Cur_Date = new Date(_date.getFullYear(), _date.getMonth(), _date.getDate(), 0, 0, 0, 0);
                var _isFound = false;
                var _CurBday = _bday[Cur_Date.getMonth()];

                //Today
                _isFound = false;
                for(var i=0;i<_CurBday.length;i++){
                    if(dateFormat(Cur_Date,'m-d')== dateFormat(new Date(_CurBday[i].startdate),'m-d')){
                        if(!_isFound){
                            b += '<div class="panel panel-default">' +
                                '<div class="panel-heading" style="background-color: #F44336;color: white;padding: 10px;text-align: left;margin-top: 10px;"><strong>Today</strong></div>';
                            _isFound = true;
                        }

                        b += '<div class="panel-body" style="background-color:#CAF6FC;">';

                        if(_CurBday[i].createdby != localStorage.getItem("memberId")){
                            b += '<strong style="float: left;margin-left: 10px;">' +  (new Date(_CurBday[i].startdate)).getDate() + '</strong>' +
                                '<strong style="float: left;margin-left: 10px;">' + _CurBday[i].subject + ' ' +
                                '<span class="fc-time">('+getSharedMemberNameByMemberId(_CurBday[i].createdby)+')</span>';
                        }else{
                            b += '<a style="cursor:pointer" class="editevent" data-eventid="'+_CurBday[i].id+'" data-eventtype="'+_CurBday[i].notetype+'" data-eventdate="'+_CurBday[i].startdate+'" data-subject="'+_CurBday[i].subject+'" data-description="'+_CurBday[i].description+'" data-createdby="'+_CurBday[i].createdby+'">' +
                                '<strong style="float: left;margin-left: 10px;">' +  (new Date(_CurBday[i].startdate)).getDate() + '</strong>' +
                                '<strong style="float: left;margin-left: 10px;">' + _CurBday[i].subject + ' ' +
                                '</a>';
                        }

                        b += '</strong>' +
                            getAge(_CurBday[i].startdate) +
                            '</div>' +
                            '<hr style="padding:0px;">';
                    }
                }
                if(_isFound){
                    b += '</div>';
                }

                //Later This Month
                _isFound = false;
                for(var i=0;i<_CurBday.length;i++){
                    if(dateFormat(Cur_Date,'m-d')< dateFormat(new Date(_CurBday[i].startdate),'m-d')){
                        if(!_isFound){
                            b += '<div class="panel panel-default">' +
                                '<div class="panel-heading" style="background-color: #F44336;color: white;padding: 10px;text-align: left;margin-top: 10px;"><strong>Later This Month</strong></div>';
                            _isFound = true;
                        }

                        b += '<div class="panel-body" style="background-color:#CAF6FC;">';

                        if(_CurBday[i].createdby != localStorage.getItem("memberId")){
                            b += '<strong style="float: left;margin-left: 10px;">' +  (new Date(_CurBday[i].startdate)).getDate() + '</strong>' +
                                '<strong style="float: left;margin-left: 10px;">' + _CurBday[i].subject + ' ' +
                                '<span class="fc-time">('+getSharedMemberNameByMemberId(_CurBday[i].createdby)+')</span>';
                        }else{
                            b += '<a style="cursor:pointer" class="editevent" data-eventid="'+_CurBday[i].id+'" data-eventtype="'+_CurBday[i].notetype+'" data-eventdate="'+_CurBday[i].startdate+'" data-subject="'+_CurBday[i].subject+'" data-description="'+_CurBday[i].description+'" data-createdby="'+_CurBday[i].createdby+'">' +
                                '<strong style="float: left;margin-left: 10px;">' +  (new Date(_CurBday[i].startdate)).getDate() + '</strong>' +
                                '<strong style="float: left;margin-left: 10px;">' + _CurBday[i].subject + ' ' +
                                '</a>';
                        }

                        b += '</strong>' +
                            getAge(_CurBday[i].startdate) +
                            '</div>' +
                            '<hr style="padding:0px;">';
                    }
                }
                if(_isFound){
                    b += '</div>';
                }

                //Rest
                if (Cur_Date.getMonth() == 11) {
                    Cur_Date = new Date(Cur_Date.getFullYear() + 1, 0, 1);
                } else {
                    Cur_Date = new Date(Cur_Date.getFullYear(), Cur_Date.getMonth() + 1, 1);
                }

                for(var j=0;j<12;j++){
                    _CurBday = _bday[Cur_Date.getMonth()];
                    if(_CurBday.length > 0){
                        _isFound = false;
                        if(Cur_Date.getMonth() == _date.getMonth()){
                            for(var i=0;i<_CurBday.length;i++){
                                if(dateFormat(_date,'m-d') > dateFormat(new Date(_CurBday[i].startdate),'m-d')){
                                    if(!_isFound){
                                        b += '<div class="panel panel-default">' +
                                            '<div class="panel-heading" style="background-color: #F44336;color: white;padding: 10px;text-align: left;margin-top: 10px;"><strong>' + name.months[Cur_Date.getMonth()] + '</strong></div>';
                                        _isFound = true;
                                    }

                                    b += '<div class="panel-body" style="background-color:#CAF6FC;">';

                                    if(_CurBday[i].createdby != localStorage.getItem("memberId")){
                                        b += '<strong style="float: left;margin-left: 10px;">' +  (new Date(_CurBday[i].startdate)).getDate() + '</strong>' +
                                            '<strong style="float: left;margin-left: 10px;">' + _CurBday[i].subject + ' ' +
                                            '<span class="fc-time">('+getSharedMemberNameByMemberId(_CurBday[i].createdby)+')</span>';
                                    }else{
                                        b += '<a style="cursor:pointer" class="editevent" data-eventid="'+_CurBday[i].id+'" data-eventtype="'+_CurBday[i].notetype+'" data-eventdate="'+_CurBday[i].startdate+'" data-subject="'+_CurBday[i].subject+'" data-description="'+_CurBday[i].description+'" data-createdby="'+_CurBday[i].createdby+'">' +
                                            '<strong style="float: left;margin-left: 10px;">' +  (new Date(_CurBday[i].startdate)).getDate() + '</strong>' +
                                            '<strong style="float: left;margin-left: 10px;">' + _CurBday[i].subject + ' ' +
                                            '</a>';
                                    }

                                    b += '</strong>' +
                                        getAge(_CurBday[i].startdate) +
                                        '</div>' +
                                        '<hr style="padding:0px;">';
                                }
                            }
                        }else{
                            for(var i=0;i<_CurBday.length;i++){
                                if(!_isFound){
                                    b += '<div class="panel panel-default">' +
                                        '<div class="panel-heading" style="background-color: #F44336;color: white;padding: 10px;text-align: left;margin-top: 10px;"><strong>' + name.months[Cur_Date.getMonth()] + '</strong></div>';
                                    _isFound = true;
                                }

                                b += '<div class="panel-body" style="background-color:#CAF6FC;">';

                                if(_CurBday[i].createdby != localStorage.getItem("memberId")){
                                    b += '<strong style="float: left;margin-left: 10px;">' +  (new Date(_CurBday[i].startdate)).getDate() + '</strong>' +
                                        '<strong style="float: left;margin-left: 10px;">' + _CurBday[i].subject + ' ' +
                                        '<span class="fc-time">('+getSharedMemberNameByMemberId(_CurBday[i].createdby)+')</span>';
                                }else{
                                    b += '<a style="cursor:pointer" class="editevent" data-eventid="'+_CurBday[i].id+'" data-eventtype="'+_CurBday[i].notetype+'" data-eventdate="'+_CurBday[i].startdate+'" data-subject="'+_CurBday[i].subject+'" data-description="'+_CurBday[i].description+'" data-createdby="'+_CurBday[i].createdby+'">' +
                                        '<strong style="float: left;margin-left: 10px;">' +  (new Date(_CurBday[i].startdate)).getDate() + '</strong>' +
                                        '<strong style="float: left;margin-left: 10px;">' + _CurBday[i].subject + ' ' +
                                        '</a>';
                                }

                                b += '</strong>' +
                                    getAge(_CurBday[i].startdate) +
                                    '</div>' +
                                    '<hr style="padding:0px;">';
                            }
                        }

                        if(_isFound){
                            b += '</div>';
                        }
                    }
                    if (Cur_Date.getMonth() == 11) {
                        Cur_Date = new Date(Cur_Date.getFullYear() + 1, 0, 1);
                    } else {
                        Cur_Date = new Date(Cur_Date.getFullYear(), Cur_Date.getMonth() + 1, 1);
                    }
                }
                
                h += b;

                h += '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '</div>';

                return h;
            }


            return h;
        }

        t.append(htl);
    }

    function Event() {

    }

    return (function () {
        self.options = $.extend(defaults, config);
        self.id = $("#" + self.options.id);
        Event();
        getBirthDayView();
    }());

};

function getAge(bday){
    h = '';
    var _bdate = new Date(bday);
    var _today = new Date();

    if(_bdate.getFullYear() > 0){
        if(_bdate.getMonth() == _today.getMonth() && _bdate.getDate() == _today.getDate() && _bdate.getFullYear() < _today.getFullYear()){
            var age = parseInt(parseInt(_today.getFullYear()) - parseInt(_bdate.getFullYear()));
            h += '<strong style="float:right;margin-right: 10px;">' + _today.toDateString() + '<small> | ' +  age + ' Years Old.</small></strong>' ;
        }else if((_bdate.getFullYear() <= _today.getFullYear() && _bdate.getMonth() == _today.getMonth() && _bdate.getDate() < _today.getDate()) ||
            (_bdate.getFullYear() <= _today.getFullYear() && _bdate.getMonth() < _today.getMonth())){
            var _adate = new Date(_today.getFullYear()+1, _bdate.getMonth(), _bdate.getDate());
            var age = parseInt(parseInt(_adate.getFullYear()) - parseInt(_bdate.getFullYear()));
            h += '<strong style="float:right;margin-right: 10px;">' + _adate.toDateString() + '<small> | Turning ' +  age + ' Years.</small></strong>' ;
        }else if(_bdate.getFullYear() < _today.getFullYear()){
            var _adate = new Date(_today.getFullYear(), _bdate.getMonth(), _bdate.getDate());
            var age = parseInt(parseInt(_adate.getFullYear()) - parseInt(_bdate.getFullYear()));
            h += '<strong style="float:right;margin-right: 10px;">' + _adate.toDateString() + '<small> | Turning ' +  age + ' Years.</small></strong>' ;
        }
    }

    return h;
}
