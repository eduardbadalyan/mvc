<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Թմbook : Register</title>
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/register_style.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#register").bind("click",function(e) {

                var name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var age = document.getElementById('age').value;
                var repeatPassword = document.getElementById('repeatPassword').value;
                var password = document.getElementById('password').value;

                e.preventDefault();
                $.ajax ({
                    url: "/register/check",
                    type: "POST",
                    data: ({name: name , email: email , password: password , repeatPassword : repeatPassword , age : age}),
                    dataType: "html",
                    //beforeSend: funcBefore,
                    success: function (answer) {

                                var nameError = document.getElementById("nameError");
                                var emailError = document.getElementById("emailError");
                                var emailEmptyError = document.getElementById("emailEmptyError");
                                var ageError = document.getElementById("ageError");
                                var repeatError = document.getElementById("repeatError");
                                var passwordError = document.getElementById("passwordError");

                                nameError.style.display = "none";
                                emailError.style.display = "none";
                                emailEmptyError.style.display = "none";
                                ageError.style.display = "none";
                                repeatError.style.display = "none";
                                passwordError.style.display = "none";

                            if(answer === "fail"){
                                if (name == "") {
                                    nameError.style.display = "block";
                                }
                                if (email == "") {
                                    emailEmptyError.style.display = "block";
                                }
                                if (email.includes('@') == false){
                                    emailEmptyError.style.display = "block";
                                }
                                if (password == "") {
                                    passwordError.style.display = "block";
                                }
                                if (age == "") {
                                    ageError.style.display = "block";
                                }
                            }
                            else if(answer === "failEmail"){
                                emailError.style.display = "block";
                            }
                            else if(answer === "failPassword"){
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
<form action="/register/check" style="max-width:500px;margin:auto" method="POST">
    <h2>Register : </h2>

    <div class="input-container">
        <i class="fa fa-user icon"></i>
        <input class="input-field" type="text" placeholder="Name" name="name" id="name">
        <span class="error" id="nameError">Write Name</span>
    </div><br>

    <div class="input-container">
        <i class="fa fa-envelope icon"></i>
        <input class="input-field" type="text" placeholder="Email" name="email" id="email">
        <span class="error" id="emailEmptyError">Write existing Email</span>
        <span class="error" id="emailError">This Email isn't free,Please write another Email</span>
    </div><br>
  
    <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Password" name="password" id="password">
        <span class="error" id="passwordError">Write Password</span>
    </div><br>

    <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Please repeat the password" name="repeatPassword" id="repeatPassword">
        <span class="error" id="repeatError">Write right Password</span>
    </div><br>

    <div class="input-container">
        <i class="fa fa-birthday-cake icon"></i>
        <input class="input-field" type="number" placeholder="Age" name="age" id="age">
        <span class="error" id="ageError">Write actual age</span>
    </div><br>

    <button type="button" id="register" class="btn">Register</button>
</form>
<form action="/" method="post" style="max-width:500px;margin:auto">
    <input type="submit" value="Cancel" class="btn" style="background-color:darkorange">
</form>

</body>
</html>