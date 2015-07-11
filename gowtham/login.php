<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">


    <title>Login/Sign-In</title>

      <link rel="stylesheet" type="text/css" href="css/normalize.css">
      <link rel="stylesheet" type="text/css" href="css/login_style.css">

       <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <script>

          function validateRegister(){
              $.ajax({
                  url:"event/addMember",
                  type: "post",
                  dataType: 'json',
                  data: $('#memberRegistration').serialize(), // provided this code executes in form.onsubmit event
                  success: function (output) {
                      debugger;
                      alert("Member Added");
                  },
                  failure: function(){
                      alert("Member Not Added");
                  }
              });

          }

      </script>
  </head>

  <body>

    <div class="logmod">
  <div class="logmod__wrapper">
    <span class="logmod__close">Close</span>
    <div class="logmod__container">
      <ul class="logmod__tabs">
        <li data-tabtar="lgm-2"><a href="#">Login</a></li>
        <li data-tabtar="lgm-1"><a href="#">Sign Up</a></li>
      </ul>
      <div class="logmod__tab-wrapper">
      <div class="logmod__tab lgm-1">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Enter your personal details <strong>to create an account</strong></span>
        </div>
        <div class="logmod__form">
          <form accept-charset="utf-8" id="memberRegistration" class="simform">
            
			<div class="sminputs">
              <div class="input string optional">
                <label class="string optional" for="user-pw">First Name *</label>
                <input class="string optional" maxlength="255" name="firstName" id="user-fanem" placeholder="First name" type="text" size="50" />
              </div>
              <div class="input string optional">
                <label class="string optional" for="user-pw-repeat">Last Name *</label>
                <input class="string optional" maxlength="255"name="lastName" id="user-lname" placeholder="Last name" type="text" size="50" />
              </div>
            </div>
			<div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Email*</label>
                <input class="string optional" maxlength="255" name="memberEmail" id="user-email" placeholder="Email" type="email" size="50" />
              </div>
            </div>
			<div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Username*</label>
                <input class="string optional" maxlength="255" id="username" placeholder="Username" type="email" size="50" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input string optional">
                <label class="string optional" for="user-pw">Password *</label>
                <input class="string optional" maxlength="255" name="memberPassword" id="user-pw" placeholder="Password" type="text" size="50" />
              </div>
			
              <div class="input string optional">
                <label class="string optional" for="user-pw-repeat">Repeat password *</label>
                <input class="string optional" maxlength="255"  id="user-pw-repeat" placeholder="Repeat password" type="text" size="50" />
              </div>
            </div>
            <div class="simform__actions">
              <input class="sumbit"  value="Sign Up" onclick="javascript: validateRegister()" />
              <span class="simform__actions-sidetext">By clicking Sign Up, you agree to our <a class="special" href="#" target="_blank" role="link">Terms & Privacy</a></span>
            </div> 
          </form>
        </div> 
        <div class="logmod__alter">
          <div class="logmod__alter-container">
            <a href="#" class="connect facebook">
              <div class="connect__icon">
                <i class="fa fa-facebook"></i>
              </div>
              <div class="connect__context">
                <span>Create an account with <strong>Facebook</strong></span>
              </div>
            </a>
          </div>
        </div> 
      </div>
      <div class="logmod__tab lgm-2">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Enter your login credentials <strong>to sign in</strong></span>
        </div> 
        <div class="logmod__form">
          <form accept-charset="utf-8" action="#" class="simform">
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Email*</label>
                <input class="string optional" maxlength="255" id="user-email" placeholder="Email" type="email" size="50" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-pw">Password *</label>
                <input class="string optional" maxlength="255" id="user-pw" placeholder="Password" type="password" size="50" />
                						<span class="hide-password">Show</span>
              </div>
            </div>
            <div class="simform__actions">
              <input class="sumbit" name="commit" type="sumbit" value="Log In" />
			  <!--<input type="checkbox" name="vehicle" value="Bike">Keep me logged in<br>-->
			  <span class="simform__actions-sidetext"><a class="special" role="link" href="#">Forgot your password?</a></span>
            </div> 
          </form>
        </div> 
       <div class="logmod__alter">
          <div class="logmod__alter-container">
            <a href="#" class="connect facebook">
              <div class="connect__icon">
                <i class="fa fa-facebook"></i>
              </div>
              <div class="connect__context">
                <span>Log in with <strong>Facebook</strong></span>
              </div>
            </a>
          </div>
        </div>
          </div>
      </div>
    </div>
  </div>
</div>
    <!--script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script-->
    <script src="js/jquery.js"></script>
    <script src="js/login_index.js"></script>
    <script src="js/member.js"></script>

  </body>
</html>
