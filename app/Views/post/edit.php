<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Թմbook : Edit Post</title>
<!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/post_style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#edit").bind("click",function(e) {

                var title = document.getElementById('title').value;
                var description = document.getElementById('description').value;

                e.preventDefault();
                $.ajax ({
                    url: "/post/edit/edit",
                    type: "POST",
                    data: ({title: title , description: description , post_id: <?=$post["id"];?>}),
                    dataType: "html",
                    //beforeSend: funcBefore,
                    success: function (answer) {

                                var titleError = document.getElementById("titleError");
                                var descriptionError = document.getElementById("descriptionError");

                                titleError.style.display = "none";
                                descriptionError.style.display = "none";

                            if(answer === "fail"){
                                if (title == "") {
                                    titleError.style.display = "block";
                                }
                                if (description == "") {
                                    descriptionError.style.display = "block";
                                }
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
        <h2>Edit post : </h2>

        <div class="input-container">
            <i class="fa fa-text-height icon"></i>
            <input class="input-field" type="text" placeholder="Title" name="title" id="title" value="<?=$post["title"];?>">
            <span class="error" id="titleError">Write Title</span>
        </div><br>

        <div class="input-container">
            <i class="fa fa-align-center icon"></i>
            <textarea class="input-field" type="text" placeholder="Description" name="description" id="description" cols="30" rows="5"><?=$post["description"];?></textarea>
            <span class="error" id="descriptionError">Write Description</span>
        </div><br>

        <div class="input-container">
            <i class="fa fa-user icon"></i>
            <p style="margin-left:20px;"><?=$user["name"];?></p>
        </div>

        <button type="button" id="edit" class="btn">Edit</button>
    </form>
    <form action="/" method="post" style="max-width:500px;margin:auto">
        <input type="submit" value="Cancel" class="btn" style="background-color:darkorange">
    </form>
</body>
</html>