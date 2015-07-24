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

function getMemberIds(){
    var m = '';
    if(localStorage.getItem("sharedClicked")!="" && localStorage.getItem("sharedClicked") != [] && localStorage.getItem("sharedClicked") != null){
        var _sharedMembers = jQuery.parseJSON(localStorage.getItem("sharedClicked"));
        $.each(_sharedMembers, function(index, value) {
            m += value.memberid + ',';
        });
    }
    m +=  localStorage.getItem("memberId");
    return m;
}

function getSharedMemberNameByMemberId(_memberid){
    var m = '';
    if(localStorage.getItem("sharedClicked")!="" && localStorage.getItem("sharedClicked") != [] && localStorage.getItem("sharedClicked") != null){
        var _sharedMembers = jQuery.parseJSON(localStorage.getItem("sharedClicked"));
        $.each(_sharedMembers, function(index, value) {
            if(value.memberid == _memberid){
                m = 'Shared By : ' + value.name;
            }
        });
    }
    return m;
}

function getEventNameByEventId(eventid){
    if(eventid == 1){
        return 'Meeting';
    }else if(eventid == 2){
        return 'Note';
    }else if(eventid == 3){
        return 'Birth Day';
    }else if(eventid == 4){
        return 'Anniversary';
    }else{
        return 'Other';
    }

}

function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

function checkEmailList(email){
    if(validateEmail(email)){
        r= false;
        $.ajax({
            url : "process/?route=user&method=checkEmail" ,
            async: false,
            data : {email : email},
            type :'post',
            success : function(e){
                r = e == 0 ? true : false ;
            },
            failure : function(){
                console.log('error');
            }
        });
        return r ;
    }else
        return false;

}
