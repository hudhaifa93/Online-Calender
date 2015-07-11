<html>
<head>
    <link rel="stylesheet" href="../../css/fullcalendar.min.css"/>
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../css/app.min.1.css"/>
    <link rel="stylesheet" href="../../css/app.min.2.css"/>
    <link rel="stylesheet" href="../../css/socicon.min.css"/>

</head>
<body>
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="space"></div>


            <div id="calendar" class="fc fc-ltr ui-widget">
                <div class="fc-toolbar">
                    <div class="fc-left"></div>
                    <div class="fc-right"></div>
                    <div class="fc-center">
                        <button type="button"
                                class="fc-prev-button ui-button ui-state-default ui-corner-left ui-corner-right"><span
                                class="ui-icon ui-icon-circle-triangle-w"></span></button>
                        <h2>June 2015</h2>
                        <button type="button"
                                class="fc-next-button ui-button ui-state-default ui-corner-left ui-corner-right"><span
                                class="ui-icon ui-icon-circle-triangle-e"></span></button>
                    </div>
                    <div class="fc-clear"></div>
                    <ul class="actions actions-alt" id="fc-actions">
                        <li class="dropdown"><a href="" data-toggle="dropdown" aria-expanded="false"><i
                                class="md md-more-vert"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="active"><a data-view="month" href="">Month View</a></li>
                                <li><a data-view="basicWeek" href="">Week View</a></li>
                                <li><a data-view="agendaWeek" href="">Agenda Week View</a></li>
                                <li><a data-view="basicDay" href="">Day View</a></li>
                                <li><a data-view="agendaDay" href="">Agenda Day View</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="fc-view-container" style="">
                    <div class="fc-view fc-month-view fc-basic-view">
                        <table>
                            <thead>
                            <tr>
                                <td class="ui-widget-header">
                                    <div class="fc-row ui-widget-header">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th class="fc-day-header ui-widget-header fc-sun">Sun</th>
                                                <th class="fc-day-header ui-widget-header fc-mon">Mon</th>
                                                <th class="fc-day-header ui-widget-header fc-tue">Tue</th>
                                                <th class="fc-day-header ui-widget-header fc-wed">Wed</th>
                                                <th class="fc-day-header ui-widget-header fc-thu">Thu</th>
                                                <th class="fc-day-header ui-widget-header fc-fri">Fri</th>
                                                <th class="fc-day-header ui-widget-header fc-sat">Sat</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="ui-widget-content">
                                    <div class="fc-day-grid-container">
                                        <div class="fc-day-grid">
                                            <div class="fc-row fc-week ui-widget-content" style="height: 135px;">
                                                <div class="fc-bg">
                                                    <table>
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-day ui-widget-content fc-sun fc-other-month fc-past"
                                                                data-date="2015-05-31"></td>
                                                            <td class="fc-day ui-widget-content fc-mon fc-past"
                                                                data-date="2015-06-01"></td>
                                                            <td class="fc-day ui-widget-content fc-tue fc-past"
                                                                data-date="2015-06-02"></td>
                                                            <td class="fc-day ui-widget-content fc-wed fc-past"
                                                                data-date="2015-06-03"></td>
                                                            <td class="fc-day ui-widget-content fc-thu fc-past"
                                                                data-date="2015-06-04"></td>
                                                            <td class="fc-day ui-widget-content fc-fri fc-past"
                                                                data-date="2015-06-05"></td>
                                                            <td class="fc-day ui-widget-content fc-sat fc-past"
                                                                data-date="2015-06-06"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="fc-content-skeleton">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <td class="fc-day-number fc-sun fc-other-month fc-past"
                                                                data-date="2015-05-31">31
                                                            </td>
                                                            <td class="fc-day-number fc-mon fc-past"
                                                                data-date="2015-06-01">1
                                                            </td>
                                                            <td class="fc-day-number fc-tue fc-past"
                                                                data-date="2015-06-02">2
                                                            </td>
                                                            <td class="fc-day-number fc-wed fc-past"
                                                                data-date="2015-06-03">3
                                                            </td>
                                                            <td class="fc-day-number fc-thu fc-past"
                                                                data-date="2015-06-04">4
                                                            </td>
                                                            <td class="fc-day-number fc-fri fc-past"
                                                                data-date="2015-06-05">5
                                                            </td>
                                                            <td class="fc-day-number fc-sat fc-past"
                                                                data-date="2015-06-06">6
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td rowspan="3"></td>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-end bgm-cyan fc-draggable">
                                                                <div class="fc-content"><span class="fc-time">12a</span>
                                                                    <span class="fc-title">Hangout with friends</span>
                                                                </div>
                                                            </a></td>
                                                            <td rowspan="3"></td>
                                                            <td rowspan="3"></td>
                                                            <td rowspan="3"></td>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-end bgm-purple fc-draggable">
                                                                <div class="fc-content"><span class="fc-time">12a</span>
                                                                    <span class="fc-title">Soccor match</span></div>
                                                            </a></td>
                                                            <td rowspan="3"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fc-event-container" rowspan="2"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-end bgm-purple fc-draggable">
                                                                <div class="fc-content"><span class="fc-time">12a</span>
                                                                    <span class="fc-title">Brunch at Beach</span></div>
                                                            </a></td>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-end bgm-cyan fc-draggable">
                                                                <div class="fc-content"><span class="fc-time">12a</span>
                                                                    <span class="fc-title">IT Meeting</span></div>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-end bgm-dark fc-draggable">
                                                                <div class="fc-content"><span class="fc-time">12a</span>
                                                                    <span class="fc-title">Job Interview</span></div>
                                                            </a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="fc-row fc-week ui-widget-content" style="height: 135px;">
                                                <div class="fc-bg">
                                                    <table>
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-day ui-widget-content fc-sun fc-past"
                                                                data-date="2015-06-07"></td>
                                                            <td class="fc-day ui-widget-content fc-mon fc-past"
                                                                data-date="2015-06-08"></td>
                                                            <td class="fc-day ui-widget-content fc-tue fc-past"
                                                                data-date="2015-06-09"></td>
                                                            <td class="fc-day ui-widget-content fc-wed fc-past"
                                                                data-date="2015-06-10"></td>
                                                            <td class="fc-day ui-widget-content fc-thu fc-past"
                                                                data-date="2015-06-11"></td>
                                                            <td class="fc-day ui-widget-content fc-fri fc-past"
                                                                data-date="2015-06-12"></td>
                                                            <td class="fc-day ui-widget-content fc-sat fc-today ui-state-highlight"
                                                                data-date="2015-06-13"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="fc-content-skeleton">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <td class="fc-day-number fc-sun fc-past"
                                                                data-date="2015-06-07">7
                                                            </td>
                                                            <td class="fc-day-number fc-mon fc-past"
                                                                data-date="2015-06-08">8
                                                            </td>
                                                            <td class="fc-day-number fc-tue fc-past"
                                                                data-date="2015-06-09">9
                                                            </td>
                                                            <td class="fc-day-number fc-wed fc-past"
                                                                data-date="2015-06-10">10
                                                            </td>
                                                            <td class="fc-day-number fc-thu fc-past"
                                                                data-date="2015-06-11">11
                                                            </td>
                                                            <td class="fc-day-number fc-fri fc-past"
                                                                data-date="2015-06-12">12
                                                            </td>
                                                            <td class="fc-day-number fc-sat fc-today ui-state-highlight"
                                                                data-date="2015-06-13">13
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-end bgm-red fc-draggable fc-resizable">
                                                                <div class="fc-content"><span class="fc-title">Meeting with client</span>
                                                                </div>
                                                                <div class="fc-resizer"></div>
                                                            </a></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="fc-row fc-week ui-widget-content" style="height: 135px;">
                                                <div class="fc-bg">
                                                    <table>
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-day ui-widget-content fc-sun fc-future"
                                                                data-date="2015-06-14"></td>
                                                            <td class="fc-day ui-widget-content fc-mon fc-future"
                                                                data-date="2015-06-15"></td>
                                                            <td class="fc-day ui-widget-content fc-tue fc-future"
                                                                data-date="2015-06-16"></td>
                                                            <td class="fc-day ui-widget-content fc-wed fc-future"
                                                                data-date="2015-06-17"></td>
                                                            <td class="fc-day ui-widget-content fc-thu fc-future"
                                                                data-date="2015-06-18"></td>
                                                            <td class="fc-day ui-widget-content fc-fri fc-future"
                                                                data-date="2015-06-19"></td>
                                                            <td class="fc-day ui-widget-content fc-sat fc-future"
                                                                data-date="2015-06-20"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="fc-content-skeleton">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <td class="fc-day-number fc-sun fc-future"
                                                                data-date="2015-06-14">14
                                                            </td>
                                                            <td class="fc-day-number fc-mon fc-future"
                                                                data-date="2015-06-15">15
                                                            </td>
                                                            <td class="fc-day-number fc-tue fc-future"
                                                                data-date="2015-06-16">16
                                                            </td>
                                                            <td class="fc-day-number fc-wed fc-future"
                                                                data-date="2015-06-17">17
                                                            </td>
                                                            <td class="fc-day-number fc-thu fc-future"
                                                                data-date="2015-06-18">18
                                                            </td>
                                                            <td class="fc-day-number fc-fri fc-future"
                                                                data-date="2015-06-19">19
                                                            </td>
                                                            <td class="fc-day-number fc-sat fc-future"
                                                                data-date="2015-06-20">20
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td class="fc-event-container" colspan="2"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-end bgm-orange fc-draggable">
                                                                <div class="fc-content"><span class="fc-time">12a</span>
                                                                    <span class="fc-title">Live TV Show</span></div>
                                                            </a></td>
                                                            <td></td>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-end bgm-blue fc-draggable fc-resizable">
                                                                <div class="fc-content"><span class="fc-title">Repeat Event</span>
                                                                </div>
                                                                <div class="fc-resizer"></div>
                                                            </a></td>
                                                            <td></td>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-not-end bgm-green fc-draggable">
                                                                <div class="fc-content"><span class="fc-time">12a</span>
                                                                    <span class="fc-title">Semester Exam</span></div>
                                                            </a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="fc-row fc-week ui-widget-content" style="height: 135px;">
                                                <div class="fc-bg">
                                                    <table>
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-day ui-widget-content fc-sun fc-future"
                                                                data-date="2015-06-21"></td>
                                                            <td class="fc-day ui-widget-content fc-mon fc-future"
                                                                data-date="2015-06-22"></td>
                                                            <td class="fc-day ui-widget-content fc-tue fc-future"
                                                                data-date="2015-06-23"></td>
                                                            <td class="fc-day ui-widget-content fc-wed fc-future"
                                                                data-date="2015-06-24"></td>
                                                            <td class="fc-day ui-widget-content fc-thu fc-future"
                                                                data-date="2015-06-25"></td>
                                                            <td class="fc-day ui-widget-content fc-fri fc-future"
                                                                data-date="2015-06-26"></td>
                                                            <td class="fc-day ui-widget-content fc-sat fc-future"
                                                                data-date="2015-06-27"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="fc-content-skeleton">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <td class="fc-day-number fc-sun fc-future"
                                                                data-date="2015-06-21">21
                                                            </td>
                                                            <td class="fc-day-number fc-mon fc-future"
                                                                data-date="2015-06-22">22
                                                            </td>
                                                            <td class="fc-day-number fc-tue fc-future"
                                                                data-date="2015-06-23">23
                                                            </td>
                                                            <td class="fc-day-number fc-wed fc-future"
                                                                data-date="2015-06-24">24
                                                            </td>
                                                            <td class="fc-day-number fc-thu fc-future"
                                                                data-date="2015-06-25">25
                                                            </td>
                                                            <td class="fc-day-number fc-fri fc-future"
                                                                data-date="2015-06-26">26
                                                            </td>
                                                            <td class="fc-day-number fc-sat fc-future"
                                                                data-date="2015-06-27">27
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-event-container" colspan="2"><a
                                                                    class="fc-day-grid-event fc-event fc-not-start fc-end bgm-green fc-draggable">
                                                                <div class="fc-content"><span class="fc-title">Semester Exam</span>
                                                                </div>
                                                            </a></td>
                                                            <td rowspan="2"></td>
                                                            <td rowspan="2"></td>
                                                            <td class="fc-event-container" colspan="3"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-end bgm-blue fc-draggable">
                                                                <div class="fc-content"><span class="fc-time">12a</span>
                                                                    <span class="fc-title">Software Conference</span>
                                                                </div>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-end bgm-orange fc-draggable">
                                                                <div class="fc-content"><span class="fc-time">12a</span>
                                                                    <span class="fc-title">Coffee time</span></div>
                                                            </a></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="fc-row fc-week ui-widget-content" style="height: 135px;">
                                                <div class="fc-bg">
                                                    <table>
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-day ui-widget-content fc-sun fc-future"
                                                                data-date="2015-06-28"></td>
                                                            <td class="fc-day ui-widget-content fc-mon fc-future"
                                                                data-date="2015-06-29"></td>
                                                            <td class="fc-day ui-widget-content fc-tue fc-future"
                                                                data-date="2015-06-30"></td>
                                                            <td class="fc-day ui-widget-content fc-wed fc-other-month fc-future"
                                                                data-date="2015-07-01"></td>
                                                            <td class="fc-day ui-widget-content fc-thu fc-other-month fc-future"
                                                                data-date="2015-07-02"></td>
                                                            <td class="fc-day ui-widget-content fc-fri fc-other-month fc-future"
                                                                data-date="2015-07-03"></td>
                                                            <td class="fc-day ui-widget-content fc-sat fc-other-month fc-future"
                                                                data-date="2015-07-04"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="fc-content-skeleton">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <td class="fc-day-number fc-sun fc-future"
                                                                data-date="2015-06-28">28
                                                            </td>
                                                            <td class="fc-day-number fc-mon fc-future"
                                                                data-date="2015-06-29">29
                                                            </td>
                                                            <td class="fc-day-number fc-tue fc-future"
                                                                data-date="2015-06-30">30
                                                            </td>
                                                            <td class="fc-day-number fc-wed fc-other-month fc-future"
                                                                data-date="2015-07-01">1
                                                            </td>
                                                            <td class="fc-day-number fc-thu fc-other-month fc-future"
                                                                data-date="2015-07-02">2
                                                            </td>
                                                            <td class="fc-day-number fc-fri fc-other-month fc-future"
                                                                data-date="2015-07-03">3
                                                            </td>
                                                            <td class="fc-day-number fc-sat fc-other-month fc-future"
                                                                data-date="2015-07-04">4
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td rowspan="2"></td>
                                                            <td rowspan="2"></td>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-end bgm-orange fc-draggable">
                                                                <div class="fc-content"><span class="fc-time">12a</span>
                                                                    <span class="fc-title">Coffee time</span></div>
                                                            </a></td>
                                                            <td rowspan="2"></td>
                                                            <td rowspan="2"></td>
                                                            <td rowspan="2"></td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-event fc-start fc-end bgm-dark fc-draggable">
                                                                <div class="fc-content"><span class="fc-time">12a</span>
                                                                    <span class="fc-title">Job Interview</span></div>
                                                            </a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="fc-row fc-week ui-widget-content" style="height: 138px;">
                                                <div class="fc-bg">
                                                    <table>
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-day ui-widget-content fc-sun fc-other-month fc-future"
                                                                data-date="2015-07-05"></td>
                                                            <td class="fc-day ui-widget-content fc-mon fc-other-month fc-future"
                                                                data-date="2015-07-06"></td>
                                                            <td class="fc-day ui-widget-content fc-tue fc-other-month fc-future"
                                                                data-date="2015-07-07"></td>
                                                            <td class="fc-day ui-widget-content fc-wed fc-other-month fc-future"
                                                                data-date="2015-07-08"></td>
                                                            <td class="fc-day ui-widget-content fc-thu fc-other-month fc-future"
                                                                data-date="2015-07-09"></td>
                                                            <td class="fc-day ui-widget-content fc-fri fc-other-month fc-future"
                                                                data-date="2015-07-10"></td>
                                                            <td class="fc-day ui-widget-content fc-sat fc-other-month fc-future"
                                                                data-date="2015-07-11"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="fc-content-skeleton">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <td class="fc-day-number fc-sun fc-other-month fc-future"
                                                                data-date="2015-07-05">5
                                                            </td>
                                                            <td class="fc-day-number fc-mon fc-other-month fc-future"
                                                                data-date="2015-07-06">6
                                                            </td>
                                                            <td class="fc-day-number fc-tue fc-other-month fc-future"
                                                                data-date="2015-07-07">7
                                                            </td>
                                                            <td class="fc-day-number fc-wed fc-other-month fc-future"
                                                                data-date="2015-07-08">8
                                                            </td>
                                                            <td class="fc-day-number fc-thu fc-other-month fc-future"
                                                                data-date="2015-07-09">9
                                                            </td>
                                                            <td class="fc-day-number fc-fri fc-other-month fc-future"
                                                                data-date="2015-07-10">10
                                                            </td>
                                                            <td class="fc-day-number fc-sat fc-other-month fc-future"
                                                                data-date="2015-07-11">11
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


    </div>
    <div class="col-sm-2"></div>

</div>
<script type="application/javascript" src="../../js/jquery.js" ></script>
<script type="application/javascript" src="../../js/bootstrap.min.js" ></script>
</body>
</html>