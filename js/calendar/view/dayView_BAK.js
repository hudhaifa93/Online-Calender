var Day = function (config) {
    'use strict';
    var $window = $(window);
    var self = this,
        defaults,
        _date = new Date(),
        notes,
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

    function drawCalender() {
        name.title = name.months[ _date.getMonth()] + " " + _date.getDate() + ", " + _date.getFullYear();
        self.id.addClass("fc fc-ltr ui-widget");
        self.id.html("");
        _head(self.id);
        var memberId = localStorage.getItem("memberId");
        $.ajax({
            url : "process/?route=Event&method=getAllNotesByStartDateAndEndDate",
            data:  { start : dateFormat(_date), end: dateFormat(_date), MemberId: memberId},
            type : "post",
            dataType: "json",
            success : function(e){
                notes = e;
                _container(self.id);
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
                '<button type="button" class="fc-prev-button ui-button ui-state-default ui-corner-left ui-corner-right">' +
                '<span id="prevDayView" class="ui-icon ui-icon-circle-triangle-w"></span></button>' +
                '<h2>' + name.title + '</h2>' +
                '<button type="button" class="fc-next-button ui-button ui-state-default ui-corner-left ui-corner-right">' +
                '<span id="nextDayView" class="ui-icon ui-icon-circle-triangle-e"></span></button>' +
                '</div>';
        }

        function _menu() {
            return '<ul class="actions actions-alt" id="fc-actions">' +
                '<li class="dropdown"><a href="" data-toggle="dropdown" aria-expanded="false">' +
                '<i class="md md-more-vert"></i></a>' +
                '<ul class="dropdown-menu dropdown-menu-right">' +
                '<li><a data-view="month" href="">Month View</a></li>' +
                '<li><a data-view="basicWeek" href="">Week View</a></li>' +
                '<li class="active"><a data-view="basicDay" href="">Day View</a></li>' +
                '</ul>' +
                '</li>' +
                '</ul> ';
        }

        t.append('<div class="fc-toolbar">' + _left() + _right() + _center() + _menu());
    }

    function _container(t) {
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
                '<th class="fc-axis ui-widget-header" style="width: 40px;"></th>' +
                '<th class="fc-day-header ui-widget-header fc-' + name.daysShort[_date.getDay()] + '">' + name.days[_date.getDay()] + '</th>' +
                '</tr>' +
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
                _fc_day_grid() +
                '<hr class="ui-widget-header">' +
                _fc_time_grid_container() +
                '</td>' +
                '</tr>';

            function _fc_day_grid() {
                var fe = '';
                for (var n = 0; n < notes.length; n++) {
                    if(notes[n].starttime == "0" && notes[n].endtime == "0"){
                        fe += '<a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable fc-resizable  '+ getColorByEventType(notes[n].notetype) + ' ">' +
                            '<div class="fc-content">' +
                            '<span class="fc-title">' +
                            notes[n].subject;
                            if(notes[n].description != ''){
                                fe += ' : ' + notes[n].description;
                            }
                            fe += '</span></div>' +
                            '<div class="fc-resizer"></div>' +
                            '</a>';
                    }

                }

                var h = '<div class="fc-day-grid">' +
                    '<div class="fc-row fc-week ui-widget-content" style="border-right-width: 1px; margin-right: 14px;">' +
                    '<div class="fc-bg">' +
                    '<table>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td class="fc-axis ui-widget-content" style="width: 41px;">' +
                    '<span>All-Day</span>' +
                    '</td>' +
                    '<td class="fc-day ui-widget-content fc-sun fc-today ui-state-highlight" data-date="2015-06-14"></td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="fc-content-skeleton">' +
                    '<table>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td class="fc-axis" style="width: 41px;"></td>' +
                    '<td>';

                if(fe != ''){
                    h += '<div class="fc-event-container">'+ fe +'</div>';
                }

                h +='</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                return h;
            }

            function _fc_time_grid_container(){
                var h = '<div class="fc-time-grid-container" style="height: 960px;">' +
                    '<div class="fc-time-grid">' +
                    fc_bg() +
                    fc_slats() +
                    '<hr class="ui-widget-header" style="display: none;">' +
                    fc_content_skeleton() +
                    '</div>' +
                    '</div>';

                function fc_bg(){
                    var h = '<div class="fc-bg">' +
                        '<table>' +
                        '<tbody>' +
                        '<tr>' +
                        '<td class="fc-axis ui-widget-content" style="width: 40px;"></td>' +
                        '<td class="fc-day ui-widget-content fc-sun fc-today ui-state-highlight" data-date="2015-06-14"></td>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '</div>';

                    return h;
                }

                function fc_slats(){
                    var h = '<div class="fc-slats">' +
                        '<table>' +
                        '<tbody>';

                    var zone = 'AM';
                    for (var c = 0; c < 12; c++) {
                        h += '<tr>' +
                            '<td class="fc-axis fc-time ui-widget-content" style="width: 40px;">' +
                            '<span>';
                        if(c==0){
                            h += '12' + zone;
                        }else{
                            h += c + '' + zone;
                        }
                        h += '</span>' +
                            '</td>' +
                            '<td class="ui-widget-content"></td>' +
                            '</tr>' +
                            '<tr class="fc-minor">' +
                            '<td class="fc-axis fc-time ui-widget-content" style="width: 40px;"></td>' +
                            '<td class="ui-widget-content"></td>' +
                            '</tr>';
                        if(c==11 && zone =='AM' ){
                            h += '<tr>' +
                                '<td class="fc-axis fc-time ui-widget-content" style="width: 40px;">' +
                                '<span>' +
                                '12PM' +
                                '</span>' +
                                '</td>' +
                                '<td class="ui-widget-content"></td>' +
                                '</tr>' +
                                '<tr class="fc-minor">' +
                                '<td class="fc-axis fc-time ui-widget-content" style="width: 40px;"></td>' +
                                '<td class="ui-widget-content"></td>' +
                                '</tr>';

                            c = 0;
                            zone = 'PM';
                        }
                    }

                    h += '</tbody>' +
                        '</table>' +
                        '</div>';

                    return h;
                }

                function fc_content_skeleton(){
                    var h = '<div class="fc-content-skeleton">' +
                        '<table>' +
                        '<tbody>' +
                        '<tr>' +
                        '<td class="fc-axis" style="width: 41px;"></td>' +
                        '<td>' +
                        '<div class="fc-event-container">' +
                        fc_event_container() +
                        '</div>' +
                        '</td>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '</div>' ;

                    function fc_event_container(){
                        var ec = '';
                        var _events = [];
                        var noOfItems = 0;
                        var _start = 2400, _end = 0;
                        for (var n = 0; n < notes.length; n++) {
                            notes[n].columnId = "";
                            if(notes[n].endtime != "0"){
                                _events.push(notes[n]);
                                ++noOfItems;
                            }
                        }

                        var _noOfCols =0;
                        var colIndex = 1;
                        var _zone = 0;
                        var _colIndex = [];
                        var raw =0;;
                        var _yyy =[];
                        for (var timeInterval = 0; timeInterval <= 2400;) {
                            var _TimeIntervalCount = 0;
                            var _xxx =[];

                            var raw = 0;
                            for (var k = 0; k < _events.length; k++) {
                                if( timeInterval == parseInt(_events[k].starttime) ||
                                    (timeInterval + 15) == parseInt(_events[k].endtime) ||
                                    (timeInterval > parseInt(_events[k].starttime) && (timeInterval + 15) < parseInt(_events[k].endtime)) ){

                                    _xxx.push([_events[k].id,_TimeIntervalCount]);
                                    _TimeIntervalCount++;
                                }
                            }
                            if(_noOfCols < _TimeIntervalCount){
                                _noOfCols = _TimeIntervalCount;
                                _yyy.push(_xxx);
                            }
                            if(_zone == 0 || _zone == 15 || _zone == 30){
                                timeInterval = timeInterval + 15;
                                _zone = _zone + 15;
                            }
                            else if(_zone == 45){
                                timeInterval = timeInterval + 55;
                                _zone = 0;
                            }
                        }

                        debugger;
                        //XXXX

                        for (var timeInterval = 0; timeInterval <= 2400;) {
                            var _xxx = [];
                            var _yyy = [];
                            for (var k = 0; k < _events.length; k++) {
                                if( timeInterval == parseInt(_events[k].starttime) ||
                                    (timeInterval + 15) == parseInt(_events[k].endtime) ||
                                    (timeInterval > parseInt(_events[k].starttime) && (timeInterval + 15) < parseInt(_events[k].endtime)) ){


                                }
                            }
                        }

                        for (var e = 0; e < _events.length; e++) {
                            notes[e].columnId = "";
                        }


                        for (var k = 0; k < _events.length; k++) {



                                if( timeInterval == parseInt(_events[k].starttime) ||
                                (timeInterval + 15) == parseInt(_events[k].endtime) ||
                                (timeInterval > parseInt(_events[k].starttime) && (timeInterval + 15) < parseInt(_events[k].endtime)) ){
                                if(notes[n].columnId = ""){
                                    notes[n].columnId = _TimeIntervalCount;
                                    notes[n].rowId = _row;
                                }
                                _TimeIntervalCount++;
                            }
                        }





                        for (var s = 0; s < _events.length; s++) {
                            var startHours = parseInt(_events[s].starttime / 100) + (_events[s].starttime % 100)/60;
                            var endHours = parseInt(_events[s].endtime / 100) + (_events[s].endtime % 100)/60;
                            var top = startHours * 40;
                            var bottom = endHours * 40;

                            if(notes[n].columnId == ""){

                            }

                            var left = 100 - ((100 / _events[s].totalitems) * (_events[s].totalitems - _events[s].itemno + 1));
                            var right = 100 - ((100 / _events[s].totalitems) * (_events[s].itemno));

                            ec += '<a class="fc-time-grid-event fc-event fc-start fc-not-end fc-draggable ' + getColorByEventType(_events[s].notetype)+'" style="top:'+top+'px; bottom: -'+bottom+'px; z-index: 1; left: '+left+'%; right: '+right+'%;">' +
                                '<div class="fc-content">' +
                                '<div class="fc-time" data-start="10:00" data-full="12:00 AM - 12:00 AM">' +
                                '<span>' + getHourlyTime(_events[s].starttime) + ' - ' + getHourlyTime(_events[s].endtime) + '</span></div>' +
                                '<div class="fc-title">' + _events[s].subject + '</div>' +
                                '</div>' +
                                '<div class="fc-bg"></div>' +
                                '</a>';
                        }

                        return ec;
                    }

                    return h;
                }

                return h;
            }

            return h;
        }

        t.append(htl);
    }

    function Event() {
        self.id.on('click', '#prevDayView', function () {
            _date.setDate(_date.getDate() - 1);
            drawCalender();
        });

        self.id.on('click', '#nextDayView', function () {
            _date.setDate(_date.getDate() + 1);
            drawCalender();
        });
    }

    return (function () {
        self.options = $.extend(defaults, config);
        self.id = $("#" + self.options.id);
        Event();
        drawCalender();
    }());

};