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
function saveBasicEvent()
{
    //debugger;
    $.ajax({
        url: "process/index.php?route=event&method=insertBasicEvent",//event.php
        type: "post",
        dataType: 'json',
        data: $('#eventForm').serialize(), // provided this code executes in form.onsubmit event
        success: function (output) {
            debugger;
            if(output.success > 0)
            {
                alert("Simple Note Added");
            }
        },
        failure: function(){
            alert("Simple Note Not Added");
        }
    });
}

function setSessionsForAdvanceNote(date){
    localStorage.setItem("tempSubject",  $("#Subject").val());
    localStorage.setItem("tempDescription",  $("#description").val());
    localStorage.setItem("tempClickedDate", date);
    window.location.href ="event/addNote";

}