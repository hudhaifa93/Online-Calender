var Week = function (config) {
    'use strict';
    var $window = $(window);
    var self = this,
        defaults,
        _date = new Date(),
        _weekStart = new Date(),
        _weekEnd = new Date(),
        weekly_notes,
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
        $.ajax({
            url : "process/?route=Event&method=getMonthlyEvents",
            data:  { start : dateFormat(_weekStart), end: dateFormat(_weekEnd) },
            type : "post",
            dataType: "json",
            success : function(e){
                weekly_notes = e;
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
                    '<td class="fc-axis ui-widget-content" style="width: 40px;"><span>all-day</span></td>';

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
                        for (var m = 0; m < weekly_notes.length; m++) {
                            if (weekly_notes[m].date == dateFormat(Cur_Date) || dateFormat( new Date(weekly_notes[m].date) ,'m-d') == dateFormat(Cur_Date,'m-d')) {
                                var _notes = weekly_notes[m].events;
                                for (var s = 0; s < _notes.length; s++) {
                                    if(_notes[s].starttime == "0"){
                                        fe += '<a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable fc-resizable '+ getColorByEventType(_notes[s].notetype) + '">' +
                                            '<div class="fc-content">' +
                                            '<span class="fc-title">' +
                                            _notes[s].subject +
                                            '</span></div>' +
                                            '<div class="fc-resizer"></div>' +
                                            '</a>';
                                    }
                                }
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
                var h = '<div class="fc-time-grid-container" style="height: 920px;">' +
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
                    debugger;
                    var h = '<div class="fc-slats">' +
                        '<table>' +
                        '<tbody>';

                    var zone = 'am';
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
                        if(c==11 && zone =='am' ){
                            c = 0;
                            zone = 'pm';
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
                        '<td class="fc-axis" style="width: 40px;"></td>';

                    for (var c = 0; c < 7; c++) {
                        h += '<td>' +
                        '<div class="fc-event-container"></div>' +
                        '</td>';
                    }

                    h += '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '</div>';

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