<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery-ui.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?=base_url()?>js/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
    <script src="//cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
</head>
<style>

    body{
        width: 960px;
        margin: 0px auto;
    }

    .modal-footer {
        border-top: 0px!important;
    }

    .tags {
        float: left;
        margin-right: 2px;
        margin-bottom: 7px;
        margin-top: 1px;
        height: 22px;
        border-radius: 4px;
        border: 1px solid #cccccc;
        font: normal 14px/20px 'Sanchez';
        background: #ebeaea;
        background: -o-linear-gradient(top, #C4CDE0, #C4CDE0);
        background: -webkit-linear-gradient(top, #C4CDE0, #C4CDE0);
        background: -moz-linear-gradient(top, #C4CDE0, #C4CDE0);
        background: -ms-linear-gradient(top, #C4CDE0, #C4CDE0);
        background: linear-gradient(top, #C4CDE0, #C4CDE0);
        filter: progid:DXImageTransform.Microsoft.Gradient(startColorStr="#C4CDE0", endColorStr="#C4CDE0");
        border-color: #cccccc;
        cursor: pointer;
        box-shadow: inset 0 2px 0 rgba(255, 255, 255, 0.3);
        padding-left: 6px;
        padding-right: 28px;
        position: relative;
    }

    .tags .delete {
        display: block;
        width: 20px;
        height: 20px;
        float: right;
        background: url('../Content/images/panel_tools.png') no-repeat -16px 0px;
        margin-left: 6px;
        border-left: 1px solid #ccc;
        position: absolute;
        top: 0;
        right: 0;
    }
</style>
<script>

    $( document ).ready(function() {
        var dataMessage = [
            {"id":"1", "Name":"Heshani"},
            {"id":"2", "Name":"Thwaraka"},
            {"id":"3", "Name":"Nifal"}
        ];

    $("#InvList").html('');

    $.each(dataMessage, function (index, item) {
         $("#InvList").append($('<div class="tags" >' + item.Name + '</div>'));
    });

    });



</script>
<body>
<div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
    <a onclick="viewNote(1)" class="btn btn-lg btn-primary" data-toggle="modal">View Meeting</a>
    <a onclick="viewAllNotes()" class="btn btn-lg btn-primary" data-toggle="modal">View All Meetings</a>

    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="TitleSubject"></h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="frmMeeting">

                        <div class="col-xs-6 form-group">
                            <label>Host</label> -
                            <label id="Hostname">Hudhaifa</label>
                        </div>
                        <div class= "col-xs-6 form-group">
                            <label>Subject</label> -
                            <label id="MeetingSubject"></label>
                        </div>
                        <div class= "col-xs-12 form-group">
                            <label>Location</label> -
                            <label id="Location"></label>
                        </div>
                        <div class="col-xs-6 form-group">
                            <label>Start Date</label> -
                            <label id="StartDate"></label>
                        </div>
                        <div class= "col-xs-6 form-group">
                            <label>End Date</label> -
                            <label id="EndDate"></label>
                        </div>
                        <div class="col-xs-6 form-group">
                            <label>Start Time</label> -
                            <label id="StartTime"></label>
                        </div>
                        <div class= "col-xs-6 form-group">
                            <label>End Time</label> -
                            <label id=EndTime"></label>
                        </div>
                        <div class= "col-xs-12 form-group">
                            <label>Meeting Description</label> -
                            <label id="Description"></label>
                        </div>
                        <div class="col-xs-12 form-group">
                            <label >Invitees</label> -
                            <div id="InvList">

                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="ViewAllMeetingsModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" >All Meetings</h4>
                </div>
                <div class="modal-body" id="allMeetings">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>


            </div>
        </div>
    </div>

</div>


<script>
    function viewNote(noteid){
        $.ajax({
            url : "<?=base_url()?>event/getMeeting?id="+noteid,
            dataType : "json",
            type:"get",
            success : function(e){
                $("#TitleSubject").text(e.subject);
                $("#MeetingSubject").text(e.subject);
                $("#Hostname").text();
                $("#Location").text(e.location);
                $("#Description").text(e.description);
                $("#StartDate").text(e.startdate);
                $("#EndDate").text(e.enddate);
                $("#StartTime").text();
                $("#EndTime").text();
                $('#myModal').modal('show');
            }
        });
    }

    function viewAllNotes(){
        $.ajax({
            url : "<?=base_url()?>event/getAllMeeting?memberId=2&type=Meeting",
            dataType : "json",
            type: "get",
            success : function(e){
                $("#allMeetings").html("");
                $.each(e, function (index, item) {
                    var meeting = '<div class="form-group" style="  background-color: rgba(224, 227, 228, 0.71);  height: 163px;  padding-top: 9px;">' +
                        '<div class= "col-xs-12 form-group">'+
                        ' <label>Location</label> - <label>test</label>'+
                        '</div>'+
                        '<div class="col-xs-6 form-group">'+
                        '<label>Meeting Name</label> - <label>Meeting One</label>'+
                        ' </div>'+
                        '<div class= "col-xs-6 form-group">'+
                        ' <label>Subject</label> -  <label >'+item.subject+'</label>'+
                        ' </div>'+
                        '<div class="col-xs-6 form-group">'+
                        '  <label>Start Date</label> - <label >'+item.startdate+'</label>'+
                        ' </div>'+
                        '<div class= "col-xs-6 form-group">'+
                        ' <label>Start Time</label> - <label>'+item.enddate+'</label>'+
                        '</div>'+
                        '<div class= "col-xs-2 form-group">'+
                        '<a onclick="viewNote(' + item.id + ')" class="btn btn-xs btn-primary" data-dismiss="modal" data-toggle="modal">View Meeting</a>'+
                        '</div>'+
                        '<div class= "col-xs-10 form-group"></div>'+
                        '</div>';
                    $("#allMeetings").append(meeting);
                });
                $('#ViewAllMeetingsModal').modal('show');
            }
        });
    }

</script>
</body>
</html>