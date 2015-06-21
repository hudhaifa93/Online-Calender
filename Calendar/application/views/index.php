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
                    <h4 class="modal-title" id="TitleSubject"></h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
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

    <script type="text/javascript" src="js/calendar/main.js?v=1.1" ></script>


    <script type="text/javascript" >
      var app = new calendar({
           id : 'calender'
        });


    </script>

</html>

