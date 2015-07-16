var Week = function (config) {
    'use strict';
    var $window = $(window);
    var self = this,
        defaults,
        _date = new Date(),
        _weekStart = new Date(),
        _weekEnd = new Date(),
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
        if (_weekStart.getDay() != 0) _weekStart.setDate(_weekStart.getDate() - _weekStart.getDay());
        _weekEnd = new Date(_weekStart.getFullYear(), _weekStart.getMonth(), _weekStart.getDate(), 0, 0, 0, 0);
        _weekEnd.setDate(_weekEnd.getDate() + 6);
        name.title = name.monthsShort[ _weekStart.getMonth()] + " " + _weekStart.getDate() + ", " + _weekStart.getFullYear() + " - " +  name.monthsShort[ _weekEnd.getMonth()] + " " + _weekEnd.getDate() + ", " + _weekEnd.getFullYear();
        self.id.addClass("fc fc-ltr ui-widget");
        self.id.html("");
        _head(self.id);
        var memberId = localStorage.getItem("memberId");
        $.ajax({
            url : "process/?route=Event&method=getAllNotesByStartDateAndEndDate",
            data:  { start : dateFormat(_weekStart), end: dateFormat(_weekEnd), MemberId: memberId},
            type : "post",
            dataType: "json",
            success : function(e){
                debugger;
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
                '<span id="prevWeekView" class="ui-icon ui-icon-circle-triangle-w"></span></button>' +
                '<h2>' + name.title + '</h2>' +
                '<button type="button" class="fc-next-button ui-button ui-state-default ui-corner-left ui-corner-right">' +
                '<span id="nextWeekView" class="ui-icon ui-icon-circle-triangle-e"></span></button>' +
                '</div>';
        }

        function _menu() {
            return '<ul class="actions actions-alt" id="fc-actions">' +
                '<li class="dropdown"><a href="" data-toggle="dropdown" aria-expanded="false">' +
                '<i class="md md-more-vert"></i></a>' +
                '<ul class="dropdown-menu dropdown-menu-right">' +
                '<li><a class="cal-view" data-view="month" >Month View</a></li>' +
                '<li class="active"><a class="cal-view" data-view="week" >Week View</a></li>' +
                '<li><a  class="cal-view" data-view="day" >Day View</a></li>' +
                '</ul>' +
                '</li>' +
                '</ul> ';
        }

        t.append('<div class="fc-toolbar">' + _left() + _right() + _center() + _menu());
    }

    function _container(t) {
        var htl = '<div class="fc-view-container" style="">' +
            '<div class="fc-view fc-agendaWeek-view fc-agenda-view">' +
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

            var wkday = new Date(_weekStart.getFullYear(), _weekStart.getMonth(), _weekStart.getDate(), 0, 0, 0, 0);

            for (var i in name.daysShort){
                h += '<th class="fc-day-header ui-widget-header fc-' + name.daysShort[i] + '">' + name.daysShort[i] + ' '+ wkday.getMonth() + '/' + wkday.getDate() + '</th>';
                wkday.setDate(wkday.getDate() + 1);
            }
            h += '</tr>' +
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
                var h = '<div class="fc-day-grid">' +
                    '<div class="fc-row fc-week ui-widget-content" style="border-right-width: 1px; margin-right: 14px;">' +
                    fc_bg() +
                    fc_content_skeleton() +
                    '</div>' +
                    '</div>';

                function fc_bg() {
                    var h = '<div class="fc-bg">' +
                    '<table>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td class="fc-axis ui-widget-content" style="width: 40px;"><span>All-Day</span></td>';

                    var fc_bg_Date = new Date(_weekStart.getFullYear(), _weekStart.getMonth(), _weekStart.getDate(), 0, 0, 0, 0);
                    for (var c = 0; c < 7; c++) {
                        if(_date.getDay() == c){
                            h += '<td class="fc-day ui-widget-content fc-sun fc-today ui-state-highlight" data-date="2015-06-14"></td>';
                        }
                        else{
                            h += '<td class="fc-day ui-widget-content fc-tue fc-future" data-date="2015-06-16"></td>';
                        }
                        fc_bg_Date.setDate(fc_bg_Date.getDate() + 1);
                    }

                    h += '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '</div>';

                    return h;
                }

                function fc_content_skeleton() {
                    var h = '<div class="fc-content-skeleton">' +
                        '<table>' +
                        '<tbody>' +
                        '<tr>' +
                        '<td class="fc-axis" style="width: 40px;"></td>';

                    var Cur_Date = new Date(_weekStart.getFullYear(), _weekStart.getMonth(), _weekStart.getDate(), 0, 0, 0, 0);
                    for (var c = 0; c < 7; c++){
                        var fe = '';
                        debugger;
                        for (var n = 0; n < notes.length; n++) {
                            if(dateFormat(Cur_Date,'m-d')>= dateFormat(new Date(notes[n].startdate),'m-d') && dateFormat(Cur_Date,'m-d')<= dateFormat(new Date(notes[n].enddate),'m-d') && notes[n].starttime == "0" && notes[n].endtime == "0"){
                                fe += '<a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable fc-resizable '+ getColorByEventType(notes[n].notetype) + '">' +
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
                        h += '<td>';
                        if(fe !=''){
                            h += '<div class="fc-event-container">'+ fe +'</div>';
                        }
                        h += '</td>';
                        Cur_Date.setDate(Cur_Date.getDate() + 1);
                    }

                    h += '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '</div>';

                    return h;
                }

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
                        '<td class="fc-axis ui-widget-content" style="width: 40px;"></td>';

                    var fc_bg_Date = new Date(_weekStart.getFullYear(), _weekStart.getMonth(), _weekStart.getDate(), 0, 0, 0, 0);
                    for (var c = 0; c < 7; c++) {
                        if(_date.getDay() == c){
                            h += '<td class="fc-day ui-widget-content fc-sun fc-today ui-state-highlight" data-date="2015-06-14"></td>';
                        }
                        else{
                            h += '<td class="fc-day ui-widget-content fc-mon fc-future" data-date="2015-06-15"></td>';
                        }
                        fc_bg_Date.setDate(fc_bg_Date.getDate() + 1);
                    }

                    h += '</tr>' +
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
                        '<td class="fc-axis" style="width: 40px;"></td>' +
                        fc_event_container() +
                        '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '</div>';

                    function fc_event_container(){
                        var ec = '';
                        var Cur_Date = new Date(_weekStart.getFullYear(), _weekStart.getMonth(), _weekStart.getDate(), 0, 0, 0, 0);

                        for (var c = 0; c < 7; c++) {
                            var _events = [];
                            var noOfItems =0;
                            for (var n = 0; n < notes.length; n++) {
                                if(dateFormat(Cur_Date)>= dateFormat(new Date(notes[n].startdate)) && dateFormat(Cur_Date)<= dateFormat(new Date(notes[n].enddate)) && notes[n].endtime != "0"){
                                    _events.push(notes[n]);
                                    ++noOfItems;
                                }
                            }

                            ec += '<td>' +
                                '<div class="fc-event-container">';

                            if(_events.length > 0){
                                var widthPortion = 100 / _events.length;
                                var left = 0, right = 0, top = 0, bottom = 0, startHours = 0, endHours = 0;
                                for (var s = 0; s < _events.length; s++) {
                                    startHours = parseInt(_events[s].starttime / 100) + (_events[s].starttime % 100)/60;
                                    endHours = parseInt(_events[s].endtime / 100) + (_events[s].endtime % 100)/60;
                                    left = 0;
                                    right = 0;
                                    top = startHours * 40;
                                    bottom = endHours * 40;

                                    ec += '<a class="fc-time-grid-event fc-event fc-start fc-not-end fc-draggable ' + getColorByEventType(_events[s].notetype)+'" style="top:'+top+'px; bottom: -'+bottom+'px; z-index: 1; left: '+left+'%; right: '+right+'%;">' +
                                        '<div class="fc-content">' +
                                        '<div class="fc-time" data-start="10:00" data-full="12:00 AM - 12:00 AM">' +
                                        '<span>' + getHourlyTime(_events[s].starttime) + ' - ' + getHourlyTime(_events[s].endtime) + '</span></div>' +
                                        '<div class="fc-title">' + _events[s].subject + '</div>' +
                                        '</div>' +
                                        '<div class="fc-bg"></div>' +
                                        '</a>';
                                }
                            }

                            ec += '</div>' +
                                '</td>';
                            Cur_Date.setDate(Cur_Date.getDate() + 1);
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
        self.id.on('click', '#prevWeekView', function () {
            _weekStart.setDate(_weekStart.getDate() - 7);
            drawCalender();
        });

        self.id.on('click', '#nextWeekView', function () {
            _weekStart.setDate(_weekStart.getDate() + 7);
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

function getAllEvents(notes_){
    var _events = [];
    for (var n = 0; n < notes_.length; n++) {
        var _notes = notes_[n].events;
        for (var n = 0; n < notes_.length; n++) {

        }
    }
}