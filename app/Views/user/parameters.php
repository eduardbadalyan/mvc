<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Թմbook : Parameters</title>
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/register_style.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#change").bind("click",function(e) {

                var name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var age = document.getElementById('age').value;

                e.preventDefault();
                $.ajax ({
                    url: "/parameters/change/check",
                    type: "POST",
                    data: ({name: name , email: email , age : age}),
                    dataType: "html",
                    //beforeSend: funcBefore,
                    success: function (answer) {

                                var nameError = document.getElementById("nameError");
                                var emailError = document.getElementById("emailError");
                                var emailEmptyError = document.getElementById("emailEmptyError");
                                var ageError = document.getElementById("ageError");

                                nameError.style.display = "none";
                                emailError.style.display = "none";
                                emailEmptyError.style.display = "none";
                                ageError.style.display = "none";

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
                                if (age == "") {
                                    ageError.style.display = "block";
                                }
                            }
                            else if(answer === "failEmail"){
                                emailError.style.display = "block";
                            }
                            else{
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
    <h2>Parameters : </h2>

    <div class="input-container">
        <i class="fa fa-user icon"></i>
        <input class="input-field" type="text" placeholder="Name" name="name" id="name" value="<?=$user["name"];?>">
        <span class="error" id="nameError">Write Name</span>
    </div><br>

    <div class="input-container">
        <i class="fa fa-envelope icon"></i>
        <input class="input-field" type="text" placeholder="Email" name="email" id="email" value="<?=$user["email"];?>">
        <span class="error" id="emailEmptyError">Write existing Email</span>
        <span class="error" id="emailError">This Email isn't free,Please write another Email</span>
    </div><br>

    <div class="input-container">
        <i class="fa fa-birthday-cake icon"></i>
        <input class="input-field" type="number" placeholder="Age" name="age" id="age" value="<?=$user["age"];?>">
        <span class="error" id="ageError">Write actual age</span>
    </div><br>

    <button type="button" id="change" class="btn">Change</button>
</form>
<form action="/" method="post" style="max-width:500px;margin:auto">
    <input type="submit" value="Cancel" class="btn" style="background-color:darkorange">
</form>

</body>
</html>