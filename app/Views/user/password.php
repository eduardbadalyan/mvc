<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Թմbook : Password</title>
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/register_style.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#change").bind("click",function(e) {

                var oldPassword = document.getElementById('oldPassword').value;
                var repeatPassword = document.getElementById('repeatPassword').value;
                var password = document.getElementById('password').value;

                e.preventDefault();
                $.ajax ({
                    url: "/password/change/check",
                    type: "POST",
                    data: ({oldPassword: oldPassword , password: password , repeatPassword : repeatPassword}),
                    dataType: "html",
                    //beforeSend: funcBefore,
                    success: function (answer) {

                                var oldPasswordError = document.getElementById("oldPasswordError");
                                var repeatError = document.getElementById("repeatError");
                                var passwordError = document.getElementById("passwordError");

                                oldPasswordError.style.display = "none";
                                repeatError.style.display = "none";
                                passwordError.style.display = "none";

                                if(answer === "failOldPassword"){
                                    oldPasswordError.style.display = "block";
                                }
                                else if(answer === "failPassword"){
                                    passwordError.style.display = "block";
                                }
                                else if(answer === "failRepeatPassword"){
                                    repeatError.style.display = "block";
                                }else{
                                    var url = "/";
                                    $(location).attr('href',url);
                                }
                    }
                });
            });
        });
    </script>
</head>
<body>
<form action="" style="max-width:500px;margin:auto" method="POST">
    <h2>Change Password : </h2>

    <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Old Password" name="password" id="oldPassword">
        <span class="error" id="oldPasswordError">Write right Password</span>
    </div><br>
  
    <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="New Password" name="password" id="password">
        <span class="error" id="passwordError">Write Password</span>
    </div><br>

    <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Please repeat the password" name="repeatPassword" id="repeatPassword">
        <span class="error" id="repeatError">Write right Password</span>
    </div><br>

    <button type="button" id="change" class="btn">Change</button>
</form>
<form action="/" method="post" style="max-width:500px;margin:auto">
    <input type="submit" value="Cancel" class="btn" style="background-color:darkorange">
</form>

</body>
</html>