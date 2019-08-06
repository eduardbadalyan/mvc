<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Թմbook : Log in</title>
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/login_style.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#login").bind("click",function(e) {
                var email = document.getElementById('email').value;
                var password = document.getElementById('password').value;
                e.preventDefault();
                $.ajax ({
                    url: "/login/auth",
                    type: "POST",
                    data: ({email: email,password: password}),
                    dataType: "html",
                    //beforeSend: funcBefore,
                    success: function (answer) {
                                var emailError = document.getElementById("emailError");
                                var passwordError = document.getElementById("passwordError");
                            if(answer === "failPassword"){
                                passwordError.style.display = "block";
                                emailError.style.display = "none";
                            }else if(answer === "failEmail"){
                                passwordError.style.display = "none";
                                emailError.style.display = "block";
                            }else if(answer === "failBoth"){
                                passwordError.style.display = "block";
                                emailError.style.display = "block";
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
<form action="/login/auth" style="max-width:500px;margin:auto" method="POST">
    <h2>Log In : </h2>

    <div class="input-container">
        <i class="fa fa-envelope icon"></i>
        <input class="input-field" type="text" placeholder="Email" name="email" id="email">
        <span class="error" id="emailError">Write right Email</span>
    </div><br>
  
    <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Password" name="password" id="password">
        <span class="error" id="passwordError">Write right Password</span>
    </div><br>

    <button type="button" id="login" class="btn">Log In</button>
</form>
<form action="/" method="post" style="max-width:500px;margin:auto">
    <input type="submit" value="Cancel" class="btn" style="background-color:darkorange">
</form>

</body>
</html>