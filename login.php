
<html>
<head>
  <?php include 'include/head.php' ?>
    <style>
        .new_alert-success{
            border: 1px solid rgb(124, 252, 124);
            background: rgb(198, 253, 198);
            position: fixed;
            top: 100px;
            right: 0;
            padding: 20px 10px;
            color:  green ;
            font-size: 15px;
            z-index: 9999999;
        }
        .new_alert-danger{
            border: 1px solid #e4b9c0;
            background: #e4b9c0;
            position: fixed;
            top: 100px;
            right: 0;
            padding: 20px 10px;
            color:  #843534 ;
            font-size: 15px;
            z-index: 9999999;
        }
    </style>

</head>
<body class="login-content">
<!-- Login -->
<div class="lc-block toggled" id="l-login">
    <form id="loginForm">
    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="md md-person"></i></span>
        <div class="fg-line">
            <input type="text" class="form-control" placeholder="Username" name="loginUsername"  id="inputUsername"  >
        </div>
    </div>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="md md-accessibility"></i></span>
        <div class="fg-line">
            <input type="password" class="form-control" name="loginPassword" placeholder="Password"  id="loginPassword" >
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="checkbox">
        <label>
            <input type="checkbox" value="">
            <i class="input-helper"></i>
            Keep me signed in
        </label>
    </div>

    <a onclick="validateLogin('loginForm')" class="btn btn-login btn-danger btn-float waves-effect waves-button waves-float"><i class="md md-arrow-forward"></i></a>
    </form>

</div>

<!-- Register -->
<div class="lc-block" id="l-register">
    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="md md-person"></i></span>
        <div class="fg-line">
            <input type="text" class="form-control" placeholder="Username" id="inputUsername" >
        </div>
    </div>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="md md-accessibility"></i></span>
        <div class="fg-line">
            <input type="password" class="form-control" placeholder="Password"  id="loginPassword" >
        </div>
    </div>

    <div class="clearfix"></div>

</div>
<?php include 'include/foot.php' ?>


</body>
</html>