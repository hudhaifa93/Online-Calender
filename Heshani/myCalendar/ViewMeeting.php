<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap.min.css">
    <script src="<?=base_url()?>js/jquery.js"></script>
</head>
<style>

    body{
        width: 960px;
        margin: 0px auto;
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

<form id="frmMeetingView" style="background-color: rgba(224, 227, 228, 0.71);">

    <table style="width:100%;">
        <tr>
            <td><label id="lblHost">Host's Name</label></td>
            <td>
                <label id="Hostname">Hudhaifa,Nifal</label>
            </td>
        </tr>
        <tr>
            <td><label id="lblMeetingSubject">Subject</label></td>
            <td>
                <label id="MeetingSubject"></label>
            </td>
        </tr>
        <tr>
            <td><label id="lblLocation">Location</label></td>
            <td>
                <label id="Location">NSBM Nugegoda</label>
            </td>
        </tr>
        <tr>
            <td><label id="lblDescription">Description</label></td>
            <td>
                <label id="Description"></label>
            </td>
        </tr>
        <tr>
            <td><label id="lblStartDate">Start Date</label></td>
            <td>
                <label id="StartDate"></label>
            </td>
            <td><label id="lblStartTime">Start Time</label></td>
            <td>
                <label id="StartTime">10:00 AM</label>
            </td>
        </tr>
        <tr>
            <td><label id="lblEndDate">End Date</label></td>
            <td>
                <label id="EndDate"></label>
            </td>
            <td><label id="lblEndTime">End Time</label></td>
            <td>
                <label id=EndTime">11:00 AM</label>
            </td>
        </tr>
        <tr>
            <td><label id="lblInvitee">Invitees</label></td>
            <td>
                <div id="InvList">

                </div>
            </td>
        </tr>
        </table>

</form>

<script>
    $.ajax({
        url : "<?=base_url()?>event/getMeeting/1",
        dataType : "json",
        success : function(e){
            debugger;
                $("#MeetingSubject").text(e.subject);
                $("#Description").text(e.description);
                $("#StartDate").text(e.startdate);
                $("#EndDate").text(e.enddate);
            console.log(e);
        }
    });
</script>
</body>
</html>