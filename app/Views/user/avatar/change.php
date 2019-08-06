<?php
    if (is_null($user['id']) == true) {
        header ("Location : /");
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Թմbook : Avatar</title>
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/avatar_style.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#change").bind("click",function(e) {
                var file_data = document.getElementById("image").files[0];
                if (file_data == undefined) {
                    alert("Please choose an image");
                }
                else{
                    var name = file_data.name;
                    var form_data = new FormData();
                    var ext = name.split('.').pop().toLowerCase();
                    if(jQuery.inArray(ext, ['png','jpg','jpeg']) == -1) 
                    {
                        alert("Invalid Image File");
                    }
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(file_data);
                    var fsize = file_data.size||file_data.fileSize;
                    if(fsize > 45000)
                    {
                        alert("Image File Size is very big.");
                    }
                    else
                    {
                        form_data.append("file", file_data);
                        $.ajax({
                            url:"/avatar/change/check",
                            method:"POST",
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success:function(data)
                            {
                                var url = "/";
                                $(location).attr('href',url);
                            }
                        });
                    }
                }
            });
        });

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
</head>
<body>
<form style="max-width:500px;margin:auto" id="chage_form" name="change" method="POST" enctype="multipart/form-data" action="">
    <h2>Change Avatar : </h2>

    <div class="input-container">
        <i class="fa fa-camera-retro icon"></i>
        <input type="file" id="image" class="input-field" name="image" accept=".jpg, .jpeg, .png" multiple onchange="loadFile(event)">
    </div><br>
    <img id="output" src="<?=$user["avatar"];?>" class="image"/><br><br>
    <button type="button" id="change" class="btn">Change</button>
</form>
<form action="/" method="post" style="max-width:500px;margin:auto">
    <input type="submit" value="Cancel" class="btn" style="background-color:darkorange">
</form>
</body>
</html>