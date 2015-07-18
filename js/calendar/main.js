var title_name = {
    days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
    daysShort: [ "Sun" , "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ],
    daysMin: ["sun", "mon", "tue", "wed", "thu", "fri", "sat"],
    months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
};

var calendar = function (config) {
    var defaults,view;

    function ViewEventHandler(){
        self.id = $("#"+self.options.id);
        self.id.on('click', '.cal-view', function () {
            config.view = $(this).data('view') ;
            render();
        });
    }

    function render(){
        view = null;
        if(config.view ==  'month'){
            view = new Month(config);
        }else if(config.view == 'week')
            view = new Week(config);
        else if(config.view == 'day')
            view = new Day(config);
    }

    return (function () {
        self.options = $.extend(defaults, config);
        ViewEventHandler();
        if( typeof config.view == 'undefined' )
            config.view = 'month';

        render();

    }());

};

function dateFormat(d, format) {
    var h = "";
    switch (format) {
        case "YYYY-m-d":
            return d.getFullYear() + "-" + (d.getMonth() + 1 > 10 ? "" : "0") + (d.getMonth() + 1) + "-" + (d.getDate() > 10 ? "" : "0") + d.getDate();
            break;
        case "m-d":
            return (d.getMonth() + 1 > 10 ? "" : "0") + (d.getMonth() + 1) + "-" + (d.getDate() > 10 ? "" : "0") + d.getDate();
            break;
        case "y":
            return d.getFullYear() ;
            break;
        case "m":
            return (d.getMonth() + 1 > 10 ? "" : "0") + (d.getMonth() + 1) ;
            break;
        case "d":
            return  (d.getDate() > 10 ? "" : "0") + d.getDate();
            break;
        case "D" :
            return title_name.daysMin[d.getDay()];
            break;
        default :
            return d.getFullYear() + "-" + (d.getMonth() + 1 > 10 ? "" : "0") + (d.getMonth() + 1) + "-" + (d.getDate() > 10 ? "" : "0") + d.getDate();
            break;
    }
}