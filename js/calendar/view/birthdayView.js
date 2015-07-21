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
        var memberId = localStorage.getItem("memberId");
        $.ajax({
            url : "process/?route=Event&method=getAllBirthDaysByMemberId",
            data:  { memberid: memberId},
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
                h += '<th class="fc-day-header ui-widget-header">Showing ' + birthdaylist.length  + ' Birthdays.</th>';
            }else{
                h += '<th class="fc-day-header ui-widget-header">Sorry, No Birthdays Available.</th>';
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
                    '<tbody>';

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
                debugger;
                for(var i=0;i<_CurBday.length;i++){
                    if(dateFormat(Cur_Date,'m-d')== dateFormat(new Date(_CurBday[i].startdate),'m-d')){
                        if(!_isFound){
                            b += '<div>' +
                                '<div>Todays Birthdays</div>';
                            _isFound = true;
                        }
                        b += '<div>' +
                            '<span>' +
                            _CurBday[i].subject +
                            '</span>' +
                            '</div>';
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
                            b += '<div>' +
                                '<div>Later This Month</div>';
                            _isFound = true;
                        }
                        b += '<div>' +
                            '<span>' +
                            _CurBday[i].subject +
                        '</span>' +
                        '</div>';
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
                                        b += '<div>' +
                                            '<div>' + name.months[Cur_Date.getMonth()] + '</div>';
                                        _isFound = true;
                                    }
                                    b += '<div>' +
                                        '<span>' +
                                        _CurBday[i].subject +
                                        '</span>' +
                                        '</div>';
                                }
                            }
                        }else{
                            for(var i=0;i<_CurBday.length;i++){
                                if(!_isFound){
                                    b += '<div>' +
                                        '<div>' + name.months[Cur_Date.getMonth()] + '</div>';
                                    _isFound = true;
                                }
                                b += '<div>' +
                                    '<span>' +
                                    _CurBday[i].subject +
                                    '</span>' +
                                    '</div>';
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
