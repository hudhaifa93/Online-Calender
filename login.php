
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

    <ul class="login-navigation">
        <li data-block="#l-register" class="bgm-orange">Sign Up</li>
    </ul>

</div>

<!-- Register -->
<div class="lc-block" id="l-register">
    <form id="signupForm">
    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="md md-person"></i></span>
        <div class="fg-line">
            <input type="text" class="form-control" id="inputFirstname" name="inputFirstname"
                   placeholder="Firstname">
            <small class="fname error hidden" > First Name Must Be contain at least 3 characters </small>
        </div>
    </div>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="md md-person"></i></span>

        <div class="fg-line">
            <input type="text" style="margin-top: 10px;" class="form-control" id="inputLastname"
                   name="inputLastname" placeholder="Lastname">
            <small class="lname error hidden" > Last Name Must Be contain at least 3 characters </small>
        </div>
    </div>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="md md-mail"></i></span>
        <div class="fg-line">
            <input type="email" style="margin-top: 10px;" class="form-control" id="inputEmail" name="inputEmail"
                   placeholder="Email">
            <small class="email error hidden" > Invalid Email Address or This Email Already use in over system </small>
        </div>
    </div>
    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="md md-accessibility"></i></span>
        <div class="fg-line">
            <input type="password" style="margin-top: 10px;" class="form-control" maxlength="20" id="inputpassword"
                   name="inputpassword" placeholder="Desired Password">
            <small class="password error hidden" > Password Must me contain 6 - 15 characters  </small>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="checkbox">
        <label>
            <input type="checkbox" value="" id="check_box">
            <i class="input-helper"></i>
            Accept the license agreement
        </label>
    </div>
    </form>
    <a onclick="createNewSignUp('signupForm')" class="btn btn-login btn-danger btn-float waves-effect waves-button waves-float"><i class="md md-arrow-forward"></i></a>

    <ul class="login-navigation">
        <li data-block="#l-login" class="bgm-green">Login</li>
    </ul>
</div>

</body>
<?php include 'include/foot.php' ?>
<script>
    $('.login-navigation li').click(function(){
        $(".lc-block").removeClass("toggled");
        $($(this).data('block')).addClass("toggled");
    });
    localStorage.clear();
</script>

</body>
</html>
