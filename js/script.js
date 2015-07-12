var calendar = function (config){
    'use strict';
    var $window = $(window);

    function UTCDate(){
        return new Date(Date.UTC.apply(Date, arguments));
    }
    function UTCToday(){
        var today = new Date();
        return UTCDate(today.getFullYear(), today.getMonth(), today.getDate());
    }

    var self = this, defaults,
        dates = {
            days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
            months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            today: "Today",
            clear: "Clear"
        };

    var Template = {
        headTemplate:   '<thead>'+
        '<tr>'+
        '<th class="prev">&laquo;</th>'+
        '<th colspan="5" class=""> </th>'+
        '<th class="next">&raquo;</th>'+
        '</tr>'+
        '</thead>',
        contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>',
        footTemplate: '<tfoot>'+
        '<tr> <th colspan="7" class="today"></th> </tr>'+
        '<tr> <th colspan="7" class="clear"></th> </tr>'+
        '</tfoot>'
    };
    Template.main = '';

    return (function(){
        self.options = $.extend(defaults,config);
        self.id = $("#"+self.options.id);
        self.id.html(Template.main);
    }());
};
