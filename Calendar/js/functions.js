/**
 * Created by Hudhaifa Yoosuf on 6/21/15.
 */


//
function getOnlyCurrentDate()
{
    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();

    var output = d.getFullYear() + '-' +
        (month<10 ? '0' : '') + month + '-' +
        (day<10 ? '0' : '') + day;

    return output;
}

//main page modal save
function saveSimpleNote()
{
    debugger;
    $.ajax({
        url: URL.base+"event/insertSimpleNote",//event.php
        type: "post",
        dataType: 'json',
        data: $('#noteForm').serialize(), // provided this code executes in form.onsubmit event
        success: function (output) {
            alert("Simple Note Added");
        },
        failure: function(){
            alert("Simple Note Not Added");
        }
    });
}