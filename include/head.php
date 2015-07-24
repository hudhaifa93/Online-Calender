<?php $user = session::get('user'); ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Code Hunters - Calendar</title>
    <link rel="stylesheet" href="css/fullcalendar.min.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/app.min.1.css"/>
    <link rel="stylesheet" href="css/app.min.2.css"/>
    <link rel="stylesheet" href="css/socicon.min.css"/>
    <link rel="stylesheet" href="css/jquery-ui.css"/>
    <style>
        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
            border-color: #eee #eee #0a6ebd;
        }
        .nav-tabs {
            border-bottom: 1px solid #ddd;
        }

        #txtSearch {
            border: 0;
            height: 40px;
            padding: 0 10px 0 40px;
            font-size: 18px;
            width: 500px;
            border-radius: 2px;
            color: white;
            background-color: rgba(255, 255, 255, 0.26);
            background-image: url("././img/icons/search.png");
            background-repeat: no-repeat;
            background-position: 10px center;
        }
        .bootstrap-tagsinput {
            width: 100%;
        }

        #footer{
            background: #f44336;
            box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.3);
            height: 100px;
            z-index: 10;
            width: 100%;
            left: 0;
            padding-right: 10px;
        }

    </style>
</head>