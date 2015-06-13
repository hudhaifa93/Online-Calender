/**
 * Created by ITMARTX on 10/1/14.
 */
var CalendarArray = [];
function getUrl() {
    return document.URL.substring(document.URL.indexOf(".lk"), document.URL)+".lk";
}
var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var today = new Date;

function buildCalendar(year, month) {
    var dt = new Date(year, month, 1, 0, 0, 0, 0);
    var next = new Date(year, month, 1, 0, 0, 0, 0);
    next.setMonth(dt.getMonth() + 1);
    next.setMilliseconds(-1);
    $('.month').html(monthNames[month]);
    $('.year').html(year);
    // day of week it starts on
    if (dt.getDay() != 0) {
        var weekday = dt.getDay() - 1;
    } else {
        var weekday = 6; // if it's a sunday
    }
    var days = next.getDate(); // amount of days in the month
    var rows = Math.ceil((weekday + days) / 7);
    var html = "";
    for (var r = 0; r < rows; r++) {
        html = html + "<tr class='calendar-row'>";
        for (var c = 0; c < 7; c++) {
            var index = (r * 7) + c; // the current index we are on
            if ((index >= weekday) && (dt.getDate() <= days) && (dt.getMonth() == next.getMonth())) {
                // today's day has to be selected
                var selected = dt.getDate() == today.getDate() && dt.getMonth() == today.getMonth() && dt.getFullYear() == today.getFullYear() ? 'selected' : '';//selected today
                var col ='silver';
                if(today.getMonth() > dt.getMonth() ) col = 'silver';
                else
                    col = getClasses(dt.getDate(),dt.getMonth(),dt.getFullYear());
                html = html + "<td style='background-color: "+col+"'   class='off-peak " + selected + " '><a data-day='"+dt.getDate()+"' data-month='"+dt.getMonth()+"' data-col='"+col+"' data-year='"+dt.getFullYear()+"' class='day-control' href='#'>" + dt.getDate() + "</a></td>";
                dt.setDate(dt.getDate() + 1);
            }
            else {
                // not within the current month
                html = html + "<td>&nbsp;</td>";
            }
        }
        html = html + "</tr>";

    }

    $(".calendar-controls").before(html);
}

function getClasses(d,m,y){
    var f= true;
    for(var i in CalendarArray){
        if(y == CalendarArray[i].year && (m+1) == CalendarArray[i].month ){
            for(var k in CalendarArray[i].day) {
                if(CalendarArray[i].day[k] == d) {
                    return '#FB7450';
                }
            }
            f = false;
        }
    }
    if(f) return 'silver';
    return 'closed';
}

$(document).on('click', '.control.next', function () {
    $('.calendar-row').each(function () {
        $(this).remove();
    });
    var year = parseInt($(this).data('year'));
    var month = parseInt($(this).data('month') + 1);
    if(month == 12){
        $(this).data('month',0);
        $(this).data('year',year+1);
        $('.control.prev').data('month',month);
        $('.control.prev').data('year',year);
    }else{
        $(this).data('month',month);
        $(this).data('year',year);
        $('.control.prev').data('month',month);
        $('.control.prev').data('year',year);
    }
    buildCalendar($(this).data('year'), $(this).data('month'));

});


$(document).on('click', '.control.prev', function () {
    $('.calendar-row').each(function () {
        $(this).remove();
    });
    var year = parseInt($(this).data('year'));
    var month = parseInt($(this).data('month') - 1);
    if(month == 0){
        $(this).data('month',12);
        $(this).data('year',year-1);
        $('.control.next').data('month',month);
        $('.control.next').data('year',year);
    }else{
        $(this).data('month',month);
        $(this).data('year',year);
        $('.control.next').data('month',month);
        $('.control.next').data('year',year);
    }
    buildCalendar(year, month);

});


// current day
function getCurrentDay() {
    var open = $('.calendar').find('.selected').children().data('open');
    var close = $('.calendar').find('.selected').children().data('close');
    $('.open-time').html("");
    $('.close-time').html("");
    if (close == "closed") {
        var status = $(this).data('open');
        $('.close-time').html("CLOSED");
    }
    else {
        $('.open-time').html(open + "am &ndash; ");
        $('.close-time').html(close + "pm");
    }
}


$(function(){
    $.ajax({
        url: getUrl() + "/Source/Ajax/GetAllOpeningTimes.php",
        dataType: "JSON",
        type: "POST",
        success: function (data) {
            for(var i in data){
                CalendarArray.push({ year: data[i].year, month: data[i].month, day: data[i].days });
            }
            var currentTime = new Date();
            buildCalendar(currentTime.getFullYear(), currentTime.getMonth());
            $('.control.prev').attr('data-year', currentTime.getFullYear());
            $('.control.prev').attr('data-month', currentTime.getMonth());
            $('.control.next').attr('data-year', currentTime.getFullYear());
            $('.control.next').attr('data-month', currentTime.getMonth());
        }
    });
});

$(document).on('click', '.off-peak', function () {
    $('.calendar').find('td').removeClass('selected');
    $(this).addClass('selected');
});
