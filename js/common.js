function getColorByEventType(type){
    //1-Meeting  -> bgm-red
    //2-Note     -> bgm-green
    //3-BirthDay -> bgm-yellow
    //4-Anniversary -> bgm-blue
    //5-Other -> bgm-purple

    if(type == "1"){
        return "bgm-red";
    }else if(type == "2"){
        return "bgm-green";
    }else if(type == "3"){
        return "bgm-yellow";
    }else if(type == "4"){
        return "bgm-blue";
    }else{
        return "bgm-purple";
    }
}

function getHourlyTime(time){
    var Hours = parseInt(time / 100);
    var Minutes  = time % 100;
    if(Minutes <10){
        Minutes = '0'+Minutes;
    }
    if(Hours == 0){
        return '12:'+Minutes+' AM';
    }else if(Hours < 10){
        return '0'+Hours+':'+Minutes+' AM';
    }else if(Hours < 12){
        return Hours+':'+Minutes+' AM';
    }else if(Hours == 12){
        return '12:'+Minutes+' PM';
    }else{
        Hours = Hours -12;
        if(Hours < 10){
            return '0'+Hours+':'+Minutes+' PM';
        }else if(Hours < 12){
            return Hours+':'+Minutes+' PM';
        }
    }
}