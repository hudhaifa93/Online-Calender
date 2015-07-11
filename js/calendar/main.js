/**
 * Created by gowtham on 6/2/15.
 */

var calendar = function (config) {
    'use strict';
    var $window = $(window);

    var self = this,
        defaults,
        _date = new Date(),
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
        }, data = null,
        main = {
            _monthFirst: new Date(_date.getFullYear(), _date.getMonth(), 1, 0, 0, 0, 0),
            _monthLast: new Date(_date.getFullYear(), _date.getMonth() + 1, 1, 0, 0, 0, -1)
        };

    function drawCalender() {
        name.title = name.months[ main._monthFirst.getMonth()] + " " + main._monthFirst.getFullYear();
        self.id.addClass("fc fc-ltr ui-widget");
        self.id.html("");
        _head(self.id);
        _container(self.id);
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
                '<span class="ui-icon ui-icon-circle-triangle-w"></span></button>' +
                '<h2>' + name.title + '</h2>' +
                '<button type="button" class="fc-next-button ui-button ui-state-default ui-corner-left ui-corner-right">' +
                '<span class="ui-icon ui-icon-circle-triangle-e"></span></button>' +
                '</div>';
        }

        function _menu() {
            return '<ul class="actions actions-alt" id="fc-actions">' +
                '<li class="dropdown"><a href="" data-toggle="dropdown" aria-expanded="false">' +
                '<i class="md md-more-vert"></i></a>' +
                '<ul class="dropdown-menu dropdown-menu-right">' +
                '<li class="active"><a data-view="month" href="">Month View</a></li>' +
                '<li><a data-view="basicWeek" href="">Week View</a></li>' +
                '<li><a data-view="agendaWeek" href="">Agenda Week View</a></li>' +
                '<li><a data-view="basicDay" href="">Day View</a></li>' +
                '<li><a data-view="agendaDay" href="">Agenda Day View</a></li>' +
                '</ul>' +
                '</li>' +
                '</ul> ';
        }

        t.append('<div class="fc-toolbar">' + _left() + _right() + _center() + _menu());
    }

    function _container(t) {
        var htl = '<div class="fc-view-container" style="">' +
            '<div class="fc-view fc-month-view fc-basic-view">' +
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
                '<div class="fc-row ui-widget-header">' +
                '<table>' +
                '<thead>' +
                ' <tr>';
            for (var i in name.daysShort)
                h += '<th class="fc-day-header ui-widget-header fc-' + name.daysShort[i] + '">' + name.daysShort[i] + '</th>';

            h += '</tr>' +
                '</thead>' +
                '</table>' +
                '</div>' +
                '</td>' +
                '</tr>';

            return h;
        }

        function _body() {

            var monthlynotes_ = '[{"date": "2015-07-11","events": [{"eventid":"1","type":"1","subject":"Apple"},{"eventid":"2","type":"1","subject":"bddf"},{"eventid":"3","type":"2","subject":"fdgdfg"},{"eventid":"4","type":"3","subject":"xcvxcv"}] },' +
                '{"date": "2015-07-15","events": [{"eventid":"5","type":"3","subject":"Basic"},{"eventid":"6","type":"3","subject":"fdgdfg"},    {"eventid":"7","type":"2","subject":"xcvxcv"},{"eventid":"8","type":"1","subject":"SAS"}]}]';

            var monthlynotes = JSON.parse(monthlynotes_);

            var d = main._monthFirst;
            var weekday = d.getDay() != 0 ? d.getDay() - 1 : 6;
            var days = main._monthLast.getDate(), rows = Math.ceil((weekday + days) / 7);
            if (d.getDay() != 0) d.setDate(d.getDate() - d.getDay());
            console.log(d);
            var h = '<tr>' +
                '<td class="ui-widget-content">' +
                ' <div class="fc-day-grid-container">' +
                '<div class="fc-day-grid">';
            for (var r = 0; r < rows; r++) {
                h += _row();
            }


            h += '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';

            function _row() {
                var h = '<div class="fc-row fc-week ui-widget-content" style="height: 135px;">' +
                    '<div class="fc-bg">' +
                    '<table>' +
                    '<tbody>' +
                    bg() +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="fc-content-skeleton">' +
                    '<table>' +
                    skeleton() +
                    '</table>' +
                    '</div>' +
                    '</div>';


                function bg() {
                    var h = '<tr>';
                    for (var c = 0; c < 7; c++) {
                        h += '<td class="fc-day ui-widget-content fc-' + dateFormat(d, 'D') + getTenses(d) + '   " data-date="' + dateFormat(d) + '"></td>';
                        d.setDate(d.getDate() + 1);
                    }
                    d.setDate(d.getDate() - 7);
                    h += '</tr>';
                    return h;
                }

                function skeleton() {
                    var h = ' <thead> <tr>';
                    var w = '';
                    for (var c = 0; c < 7; c++) {
                        var Cur_Date = dateFormat(d);
                        w += '<td>';
                        for (var m = 0; m < monthlynotes.length; m++) {
                            if (monthlynotes[m].date == Cur_Date) {
                                var daynotes = monthlynotes[m].events;
                                for (var s = 0; s < daynotes.length; s++) {
                                    var bgcolor = "bgm-purple";
                                    if(daynotes[s].type == "1"){
                                        bgcolor = "bgm-red";
                                    }else if(daynotes[s].type == "3"){
                                        bgcolor = "bgm-green";
                                    }
                                    w += '<a class="fc-day-grid-event fc-event fc-start fc-end '+bgcolor+' fc-draggable">' +
                                        '<div class="fc-content">' +
                                        /* '<span class="fc-time">12a</span>'+*/
                                        '<span class="fc-title">' + daynotes[s].subject + '</span>' +
                                        '</div>' +
                                        '</a>';
                                }
                                break;
                            }
                        }
                        w += '</td>';
                        h += '<td class="fc-day-number fc-' + dateFormat(d, 'D') + getTenses(d) + '  " data-date="' + dateFormat(d) + '">' + d.getDate() + ' </td>';
                        d.setDate(d.getDate() + 1);
                    }

                    h += '</tr>' +
                        '</thead>' +
                        '<tbody>' +
                        '<tr>' + w + '</tr>' +
                        '</tbody>';

                    return h;
                }
                return h;
            }
            return h;
        }
        t.append(htl);
    }

    function dateFormat(d, format) {
        var h = "";
        switch (format) {
            case "YYYY-m-d":
                return d.getFullYear() + "-" + (d.getMonth() + 1 > 10 ? "" : "0") + (d.getMonth() + 1) + "-" + (d.getDate() > 10 ? "" : "0") + d.getDate();
                break;
            case "D" :
                return name.daysMin[d.getDay()];
                break;
            default :
                return d.getFullYear() + "-" + (d.getMonth() + 1 > 10 ? "" : "0") + (d.getMonth() + 1) + "-" + (d.getDate() > 10 ? "" : "0") + d.getDate();
                break;
        }

    }

    function getTenses(d) {
        if (d.getMonth() == _date.getMonth())
            if (d.getDate() == _date.getDate())
                return " fc-today ";
            else if (d.getDate() > _date.getDate())
                return " fc-future ";
            else return " fc-past ";
        else if (d.getMonth() > _date.getMonth())
            return " fc-other-month fc-future ";
        else return " fc-other-month fc-past ";

    }

    function Event() {
        self.id.on('click', '.ui-icon-circle-triangle-e', function () {
            var mon = self.id.data('month'),
                year = self.id.data('year');

            if (mon == 12) {
                mon = 0;
                year++;
            } else
                mon++;
            self.id.data('year', year);
            self.id.data('month', mon);
            main._monthFirst = new Date(year, mon, 1, 0, 0, 0, 0);
            main._monthLast = new Date(year, mon + 1, 1, 0, 0, 0, -1);

            drawCalender();
        });

        self.id.on('click', '.ui-icon-circle-triangle-w', function () {
            var mon = self.id.data('month'),
                year = self.id.data('year');

            if (mon == 0) {
                mon = 12;
                year--;
            } else
                mon--;
            self.id.data('year', year);
            self.id.data('month', mon);
            main._monthFirst = new Date(year, mon, 1, 0, 0, 0, 0);
            main._monthLast = new Date(year, mon + 1, 1, 0, 0, 0, -1);
            drawCalender();
        });

        self.id.on('click', '.fc-day', function () {
            console.log($(this).index());
            console.log($(this).closest('.fc-week').index());
            openModal($(this).data('date'));
        });

        function openModal(date) {
            $('#eventForm')[0].reset();
            $('#birthdayForm')[0].reset();
            $('#CommonModal').modal('show');
            $("#ClickedDate").text(date);
            $(".ClickedDate").val(date);
            $(".CurrentDate").val(getOnlyCurrentDate());
            $('.advance-view').click(function () {
                setSessionsForAdvanceNote(date);
            });
        }

    }

    function loadNotes() {
        //  debugger;
        $.ajax({
            url: URL.base + "Event/getAllMeeting",
            dataType: "JSON",
            success: function (e) {
                data = e;
            }
        });
    }


    return (function () {
        self.options = $.extend(defaults, config);
        self.id = $("#" + self.options.id);
        self.id.data('year', _date.getFullYear());
        self.id.data('month', _date.getMonth());
        // loadNotes();
        Event();
        drawCalender();
    }());


};


/*

 '<a class="fc-day-grid-event fc-event fc-not-start fc-end bgm-green fc-draggable">' +
 '<div class="fc-content"><span class="fc-title">Semester Exam</span>' +
 ' </div>' +
 '</a>'

 */