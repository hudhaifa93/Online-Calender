var Day = function (config) {
    'use strict';
    var $window = $(window);
    var self = this,
        defaults,
        _date = new Date(),
        daily_notes,
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
        $.ajax({
            url : "process/?route=Event&method=getMonthlyEvents",
            data:  { start : dateFormat(_date), end: dateFormat(_date) },
            type : "post",
            dataType: "json",
            success : function(e){
                daily_notes = e;
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

                var Cur_Date = new Date(_date.getFullYear(), _date.getMonth(), _date.getDate(), 0, 0, 0, 0);
                var fe = '';
                for (var r = 0; r < daily_notes.length; r++) {
                    if (daily_notes[r].date == dateFormat(Cur_Date) || dateFormat( new Date(daily_notes[r].date) ,'m-d') == dateFormat(Cur_Date,'m-d')) {
                        var _notes = daily_notes[r].events;
                        for (var s = 0; s < _notes.length; s++) {
                            if(_notes[s].starttime == "0"){
                                fe += '<a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable fc-resizable  '+ getColorByEventType(_notes[s].notetype) + ' ">' +
                                    '<div class="fc-content">' +
                                    '<span class="fc-title">' +
                                    _notes[s].subject;
                                if(_notes[s].description != ''){
                                    fe += ' : ' + _notes[s].description;
                                }
                                fe += '</span></div>' +
                                    '<div class="fc-resizer"></div>' +
                                    '</a>';
                            }
                        }
                    }
                }

                var h = '<div class="fc-day-grid">' +
                    '<div class="fc-row fc-week ui-widget-content" style="border-right-width: 1px; margin-right: 14px;">' +
                    '<div class="fc-bg">' +
                    '<table>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td class="fc-axis ui-widget-content" style="width: 41px;">' +
                    '<span>all-day</span>' +
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
                        '<td class="fc-axis ui-widget-content" style="width: 40px;"></td>' +
                        '<td class="fc-day ui-widget-content fc-sun fc-today ui-state-highlight" data-date="2015-06-14"></td>' +
                        '</tr>' +
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
                        '<td class="fc-axis" style="width: 41px;"></td>' +
                        '<td>' +
                        '<div class="fc-event-container">' +

                        '<a class="fc-time-grid-event fc-event fc-start fc-not-end bgm-orange fc-draggable" style="top: 0px; bottom: -960px; z-index: 1; left: 0%; right: 50%;">' +
                        '<div class="fc-content">' +
                        '<div class="fc-time" data-start="12:00" data-full="12:00 AM - 12:00 AM">' +
                        '<span>12:00 - 12:00</span></div>' +
                        '<div class="fc-title">Live TV Show</div>' +
                        '</div>' +
                        '<div class="fc-bg"></div>' +
                        '</a>' +


                        '</div>' +
                        '</td>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '</div>' ;
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
