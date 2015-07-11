<!DOCTYPE html>
<html lang="en">
<head>
    <title>Example of Bootstrap 3 Modals</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css"/>
    <script src="//cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
    <script src="js/googleAddress.js"></script>
    <style type="text/css">
        body {
            width: 960px;
            margin: 0px auto;
        }

        .bs-example {
            margin: 20px;
        }

        .modal-footer {
            border-top: 0px !important;
        }

        .bootstrap-tagsinput {
            width: 100%;
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

        .modal .modal-body {
            max-height: 420px;
            overflow-y: auto;
        }
    </style>
    <script>

        $(document).ready(function () {
            initialize();//Google Address Initilization
            $("#StartDate").datepicker({
                dateFormat: "yy mm d"
            });
            $("#EndDate").datepicker({
                dateFormat: "yy mm d"
            });

            $("#fullday").change(function () {
                if (this.checked) {
                    $("#timeAllocation").hide();
                }
                else {
                    $("#timeAllocation").show();
                }
            });
            $("#addLocation").change(function () {
                if (this.checked) {
                    $("#locationAllocation").show();
                }
                else {
                    $("#locationAllocation").hide();
                }
            });

            var dataMessage = [
                {"id": "1", "Name": "Heshani"},
                {"id": "2", "Name": "Thwaraka"},
                {"id": "3", "Name": "Nifal"}
            ];

            $("#InvList").html('');

            $.each(dataMessage, function (index, item) {
                $("#InvList").append($('<div class="tags" onclick="addToInvitedList(' + "'inv_" + item.id + "'" + ',' + "'" + item.Name + "'" + ')" id="inv_' + item.id + '" >' + item.Name + '</div>'));
            });

            $("#repeats")
                .change(function () {
                    debugger;
                    if ($("#repeats option:selected").val() == "week") {
                        var combo = $("#repeatCombo");
                        combo.empty();
                        for (var i = 1; i < 11; i++) {
                            combo.append($("<option />").val(i).text(i));
                        }
                    }
                    else if ($("#repeats option:selected").val() == "day") {
                        var combo = $("#repeatCombo");
                        for (var i = 1; i < 31; i++) {
                            combo.append($("<option />").val(i).text(i));
                        }
                    }
                    else if ($("#repeats option:selected").val() == "year") {
                        var combo = $("#repeatCombo");
                        combo.empty();
                        for (var i = 1; i < 5; i++) {
                            combo.append($("<option />").val(i).text(i));
                        }
                    }
                    else if ($("#repeats option:selected").val() == "month") {
                        var combo = $("#repeatCombo");
                        combo.empty();
                        for (var i = 1; i < 24; i++) {
                            combo.append($("<option />").val(i).text(i));
                        }
                    }
                })
                .change();

        });

        function addToInvitedList(id, name) {
            debugger;
            $("#InvitedList").append($('<div class="tags"  id="invited_' + id + '" >' + name + ' <a class="glyphicon glyphicon-trash" onclick="removeFromInvitedList(' + "'invited_" + id + "'" + ',' + "'" + name + "'" + ')"></a></div>'));
            $("#" + id).remove();
        }

        function removeFromInvitedList(id, name) {
            debugger;
            var idInv = id.replace('invited_', '');

            $("#" + id).remove();
            $("#InvList").append($('<div class="tags" onclick="addToInvitedList(' + "'" + idInv + "'" + ',' + "'" + name + "'" + ')" id="' + idInv + '" >' + name + '</div>'));

        }


        function validateSave() {
            $.ajax({
                url: "event/insertMeeting",
                type: "post",
                dataType: 'json',
                data: $('#frmMeeting').serialize(), // provided this code executes in form.onsubmit event
                success: function (output) {
                    alert("Meeting Added");
                },
                failure: function () {
                    alert("Meeting Not Added");
                }
            });
        }

    </script>

</head>
<body>
<form role="form" id="frmMeeting">

    <div class="col-xs-6 form-group">
        <label>Subject</label>
        <input type="text" class="form-control" name="Subject" id="Subject" placeholder="Subject"/>
    </div>
    <div class="col-xs-6 form-group">
    </div>
    <div class="col-xs-12 form-group">
        <label>Location</label>
        <input type="checkbox" id="addLocation">
    </div>
    <div id="locationAllocation" style="display:none    ">
        <div class="col-xs-12 form-group">
            <!-- <label>Location</label> -->
            <!-- <input type="text" class="form-control" name="Location" id="Location" placeholder="Location"/> -->
            <input type="text" id="autocomplete" placeholder="Enter your address"/>
            <input type="text" class="googleAddress" id="street"/>
            <input type="text" class="googleAddress" id="city"/>
            <input type="text" class="googleAddress" id="state"/>
            <input type="text" class="googleAddress" id="country"/>
        </div>
    </div>
    <div class="col-xs-6 form-group">
        <label>Start Date</label>
        <input type="text" class="form-control" name="StartDate" id="StartDate" placeholder="Start Date"/>
    </div>
    <div class="col-xs-6 form-group">
        <label>End Date</label>
        <input type="text" class="form-control" name="EndDate" id="EndDate" placeholder="End Date"/>
    </div>
    <div class="col-xs-12 form-group">
        <label>Full Day</label>
        <input type="checkbox" id="fullday" checked="checked">
    </div>
    <div id="timeAllocation" style="display:none">
        <div class="col-xs-6 form-group">
            <label>Start Time</label>
            <input type="text" class="form-control" name="StartTime" id="StartTime" placeholder="Start Time"/>
        </div>
        <div class="col-xs-6 form-group">
            <label>End Time</label>
            <input type="text" class="form-control" name="EndTime" id="EndTime" placeholder="End Time"/>
        </div>
    </div>
    <div class="col-xs-12 form-group">
        <label>Meeting Description</label>
        <textarea class="form-control custom-control" name="Description" id="Description" rows="5"
                  style="resize:none"></textarea>
    </div>
    <div class="col-xs-12 form-group">
        <label>Invitees</label> -
        <div id="InvList">
        </div>
    </div>
    <div class="col-xs-12 form-group">
        <label>Invited List</label> -
        <div id="InvitedList">
        </div>
    </div>


    <div class="col-xs-12 form-group">
        <table width="80%" style="width:100%; border-collapse:separate; border-spacing:5px 10px; margin-top:20px;">
            <td width="11%">
                <tr>
                    <td>Repeats</td>
                    <td width="89%" style="width:30%">
                        <select name="" id="repeats" class="form-control" style="width:30%;">
                            <option value="day">Daily</option>
                            <option value="week">Weekly</option>
                            <option value="month">Monthly</option>
                            <option value="year">Yearly</option>
                        </select></td>
                </tr>

                <tr>
                    <td>Repeat Every</td>
                    <td><select name="" id="repeatCombo" class="form-control" style="width:30%;">

                        </select> weeks
                    </td>
                </tr>
                <tr>
                    <td>Repeat On</td>
                    <td>
                        <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox1"
                                                              value="option1">S</label>
                        <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox2"
                                                              value="option2">M</label>
                        <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox3"
                                                              value="option3">T</label>
                        <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox4"
                                                              value="option4">W</label>
                        <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox5"
                                                              value="option5">T</label>
                        <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox6"
                                                              value="option6">F</label>
                        <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox7"
                                                              value="option7">S</label>
                    </td>
                </tr>

                <tr>
                    <td>Starts On</td>
                    <td><input type="text" id="startsOn" name="startsOn" class="form-control" placeholder="Starts On"
                               style="width:250px;"/></td>
                </tr>
                <tr>

                    <td> Ends On</td>
                    <td>


                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                Never
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                After<input type="text" id="startsOn" name="startsOn" class="form-control"
                                            style="width:100px;"/>occurences
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                                On<input type="text" id="startsOn" name="startsOn" class="form-control"
                                         style="width:100px;"/>
                            </label>
                        </div>

                    </td>
                </tr>

                <tr>
                    <td>
                        <button type="submit" class="btn btn-primary btn-sm  style2"
                                onclick="javascript: validateSave()" ty>SAVE
                        </button>

                </tr>
        </table>
    </div>


</form>


<div class="col-xs-12 form-group">
    <button type="button" class="btn btn-primary" onclick="javascript: validateSave()">Save changes</button>
</div>


</body>
</html>                                		                                		