var Month = function (config) {
    'use strict';
    var $window = $(window);

    var self = this,
        defaults,
        _date = new Date(),monthly_notes,
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
        var d = main._monthFirst;
        var weekday = d.getDay() != 0 ? d.getDay() - 1 : 6;
        var days = main._monthLast.getDate(), rows = Math.ceil((weekday + days) / 7);
        var end = new Date(d) ;
        end.setDate(d.getDate()+(rows*7));
        $.ajax({
            url : "process/?route=Event&method=getMonthlyEvents",
            data:  { start : dateFormat(d), end: dateFormat(end) },
            type : "post",
            dataType: "json",
            success : function(e){
                monthly_notes = e;
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
                '<span id="prevMonthView" class="ui-icon ui-icon-circle-triangle-w"></span></button>' +
                '<h2>' + name.title + '</h2>' +
                '<button type="button" class="fc-next-button ui-button ui-state-default ui-corner-left ui-corner-right">' +
                '<span id="nextMonthView" class="ui-icon ui-icon-circle-triangle-e"></span></button>' +
                '</div>';
        }

        function _menu() {
            return '<ul class="actions actions-alt" id="fc-actions">' +
                '<li class="dropdown"><a href="" data-toggle="dropdown" aria-expanded="false">' +
                '<i class="md md-more-vert"></i></a>' +
                '<ul class="dropdown-menu dropdown-menu-right">' +
                '<li class="active" ><a class="cal-view" data-view="month" >Month View</a></li>' +
                '<li><a class="cal-view"  data-view="week" >Week View</a></li>' +
                '<li><a class="cal-view"  data-view="day">Day View</a></li>' +
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
            var d = main._monthFirst;
            var weekday = d.getDay() != 0 ? d.getDay() - 1 : 6;
            var days = main._monthLast.getDate(), rows = Math.ceil((weekday + days) / 7);
            if (d.getDay() != 0) d.setDate(d.getDate() - d.getDay());

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
                        h += '<td class="fc-day ui-widget-content fc-' + dateFormat(d, 'D') + getTenses(d) +  '   " data-date="' + dateFormat(d) + '"></td>';
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
                        w += '<td  >';
                        for (var m = 0; m < monthly_notes.length; m++) {
                            if (monthly_notes[m].date == Cur_Date  || dateFormat( new Date(monthly_notes[m].date) ,'m-d') == dateFormat(d,'m-d')  ) {
                                var daynotes = monthly_notes[m].events;
                                if( typeof daynotes == "object")
                                    for (var s = 0; s < daynotes.length; s++) {
                                        var bgcolor = "bgm-purple";
                                        if(daynotes[s].notetype == "1"){
                                            bgcolor = "bgm-red";
                                        }else if(daynotes[s].notetype == "3"){
                                            bgcolor = "bgm-green";
                                        }
                                        w += '<a class="fc-day-grid-event fc-event fc-start fc-end '+bgcolor+' fc-draggable editevent" data-eventid="'+daynotes[s].id+'" data-eventtype="'+daynotes[s].notetype+'" data-eventdate="'+daynotes[s].startdate+'" data-subject="'+daynotes[s].subject+'" data-description="'+daynotes[s].description+'">' +
                                            '<div class="fc-content">';

                                        if(daynotes[s].starttime != "0"){
                                            w += '<span class="fc-time">'+daynotes[s].starttime +'-'+daynotes[s].endtime+'</span>';
                                        }

                                        w += '<span class="fc-title">' + daynotes[s].subject + '</span>' +
                                            '</div>' +
                                            '</a>';
                                    }
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
        self.id.on('click', '#prevMonthView', function () {
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

        self.id.on('click', '#nextMonthView', function () {
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

        self.id.on('click', '.fc-day', function () {
            console.log($(this).index());
            console.log($(this).closest('.fc-week').index());
            openModal($(this).data('date'));
        });

        self.id.on('click', '.editevent', function () {
            openModelForEdit($(this));
        });

        function openModal(date) {
            //alert("normalModal");
            $('#eventForm')[0].reset();
            $('#birthdayForm')[0].reset();
            $('#CommonModal').modal('show');
            $('.nav-tabs a[href="#eventTab"]').tab('show');
            $("#ClickedDate").text(date);
            $(".ClickedDate").val(date);
            $(".CurrentDate").val(getOnlyCurrentDate());

            $("#Bdate").val(dateFormat(new Date(date),'d'));
            $("#Bmonth").val(dateFormat(new Date(date),'m'));
            $("#Byear").val(dateFormat(new Date(date),'y'));

            resetModalButton();

            $('#advance-view-meeting').click(function () {
                setSessionsForAdvanceNote(date);
            });

            $('#advance-view-note').click(function () {
                setSessionsForAdvanceNote(date);
            });

        }

        function resetModalButton(){
            $("#eventButton").attr("onclick","saveBasicEvent('eventForm')");
            $("#birthdayButton").attr("onclick","saveBasicEvent('birthdayForm')");
            $("#meetingButton").attr("onclick","saveBasicEvent('meetingForm')");
            $("#eventButtonDelete").hide();
            $("#birthdayButtonDelete").hide();
            $("#meetingButtonDelete").hide();
        }

        function openModelForEdit(event) {
            debugger;
           // alert("editModal");

            resetModalButton();

            $('#eventForm')[0].reset();
            $('#birthdayForm')[0].reset();
            $('#CommonModal').modal('show');

            $("#ClickedDate").text(event.data('eventdate'));
            $(".ClickedDate").val(event.data('eventdate'));

            if(event.data('eventtype')=="1")//meeting
            {
                $("#MeetingName").val(event.data('subject'));
                $("#MeetingDescription").val(event.data('description'));
                $('.nav-tabs a[href="#MeetingTab"]').tab('show');
                $("#meetingButton").attr("onclick","editBasicEvent('meetingForm','"+event.data('eventid')+"')");
                $("#meetingButtonDelete").attr("onclick","deleteBasicEvent('meetingForm','"+event.data('eventid')+"')");
                $("#meetingButtonDelete").show();

                $('#advance-view-meeting').click(function () {
                    editAdvanceNote(event.data('eventid'));
                });

            }
            else if(event.data('eventtype')=="2")//note
            {
                $("#Subject").val(event.data('subject'));
                $("#description").val(event.data('description'));
                $('.nav-tabs a[href="#eventTab"]').tab('show');
                $("#eventButton").attr("onclick","editBasicEvent('eventForm','"+event.data('eventid')+"')");
                $("#eventButtonDelete").attr("onclick","deleteBasicEvent('eventForm','"+event.data('eventid')+"')");
                $("#eventButtonDelete").show();

                $('#advance-view-note').click(function () {
                    editAdvanceNote(event.data('eventid'));
                });

            }
            else if(event.data('eventtype')=="3")//birthday
            {
                $("#BirthDayName").val(event.data('subject'));
                $("#description").val(event.data('description'));
                $('.nav-tabs a[href="#birthdayTab"]').tab('show');
                $("#birthdayButton").attr("onclick","editBasicEvent('birthdayForm','"+event.data('eventid')+"')");
                $("#birthdayButtonDelete").attr("onclick","deleteBasicEvent('birthdayForm','"+event.data('eventid')+"')");
                $("#birthdayButtonDelete").show();

            }
            $("#Bdate").val(dateFormat(new Date(event.data('eventdate')),'d'));
            $("#Bmonth").val(dateFormat(new Date(event.data('eventdate')),'m'));
            $("#Byear").val(dateFormat(new Date(event.data('eventdate')),'y'));
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