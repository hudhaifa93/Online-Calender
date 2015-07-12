function getColorByEventType(type){
    //1-Meeting  -> bgm-red
    //2-Note     -> bgm-green
    //3-BirthDay -> bgm-yellow

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