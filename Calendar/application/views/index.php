<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Calender</title>
    <link rel="stylesheet" href="css/fullcalendar.min.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/app.min.1.css"/>
    <link rel="stylesheet" href="css/app.min.2.css"/>
    <link rel="stylesheet" href="css/socicon.min.css"/>
    <script>
        URL = {
            base :  "<?=base_url()?>",
            current : "<?=current_url()?>"
        }
    </script>
</head>
<body>
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="space"></div>
        <div id="calender"></div>
    </div>


    <div id="CommonModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="ClickedDate"></h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="noteForm">

                        <input type=hidden name=timeslotid value="0">
                        <input type=hidden name=status value="1">
                        <input type=hidden class="ClickedDate" name=startdate value="">
                        <input type=hidden class="ClickedDate" name=enddate value="">
                        <input type=hidden id="CurrentDate" name=createddate value="">
                        <input type=hidden name=createdby value="2">
                        <input type=hidden name=notetype value="2">
                        <input type=hidden name=location value="0">



                        <div class= "col-xs-12 form-group">
                            <input type="text" class="form-control" name="subject" id="Subject" placeholder="Subject"/>
                        </div>
                        <div class= "col-xs-12 form-group">
                            <textarea class="form-control custom-control" placeholder="Description" name="description" id="description" rows="5" style="resize:none"></textarea>
                        </div>
                        <a style="cursor: pointer" class="advance-view" >Advance Options</a>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" onclick="saveSimpleNote()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

</body>

    <script type="text/javascript" src="js/jquery.js" ></script>

    <script type="text/javascript" src="js/bootstrap.min.js" ></script>

    <script type="text/javascript" src="js/jquery-ui.custom.min.js" ></script>
<script src='http://alasql.org/console/xlsx.core.min.js'></script>
<script src='http://alasql.org/console/alasql.min.js'></script>
    <script type="text/javascript" src="js/calendar/main.js?v=1.1" ></script>


    <script type="text/javascript" >

        URL = {
            base : "<?= base_url() ?>",
            current : "<?= current_url()?>"
        };

      var app = new calendar({
           id : 'calender'
        });

    </script>

    <script type="text/javascript" src="js/functions.js" ></script>

</html>

