<html>
    <head>
        <title>Թմbook</title>
        <link   rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
                                 integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
                                 crossorigin="anonymous">
        <link rel="stylesheet" href="/css/styles.css">
        <link href="/fontawesome/css/all.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $(".delete").bind("click",function(e) {
                    e.preventDefault();
                    var post_id = parseFloat(e["toElement"]["name"]);
                    $.ajax ({
                        url: "/post/delete",
                        type: "POST",
                        data: ({id: post_id}),
                        dataType: "html",
                        //beforeSend: funcBefore,
                        success: function (answer) {
                            var column = document.getElementById("column" + post_id);
                            column.style.display = "none";
                        }
                    });
                });
            });

            $(document).ready(function () {
                $(".btn-like").bind("click",function(e) {
                    e.preventDefault();
                    var post_id = parseFloat(e["currentTarget"]["name"])
                    $.ajax ({
                        url: "/post/like",
                        type: "POST",
                        data: ({post_id: post_id , user_id: <?=$user['id'];?>}),
                        dataType: "html",
                        //beforeSend: funcBefore,
                        success: function (answer) {
                            var like = document.getElementById(post_id + "like");
                            var dislike = document.getElementById(post_id + "dislike");

                            var count_likes = parseFloat(document.getElementById(post_id + "clike").innerHTML);
                            var count_dislikes = parseFloat(document.getElementById(post_id + "cdislike").innerHTML);

                            if (answer === "add") {
                                like.style.color = "blue";
                                count_likes++;
                            }
                            else if(answer === "subtract") {
                                like.style.color = "grey";
                                count_likes--;
                            }
                            else if(answer === "change"){
                                like.style.color = "blue";
                                dislike.style.color = "grey";
                                count_likes++;
                                count_dislikes--;
                            }

                            document.getElementById(post_id + "clike").innerHTML = count_likes;
                            document.getElementById(post_id + "cdislike").innerHTML = count_dislikes;
                        }
                    });
                });
            });

            $(document).ready(function () {
                $(".btn-dislike").bind("click",function(e) {
                    e.preventDefault();
                    var post_id = parseFloat(e["currentTarget"]["name"]);
                    $.ajax ({
                        url: "/post/dislike",
                        type: "POST",
                        data: ({post_id: post_id , user_id: <?=$user['id'];?>}),
                        dataType: "html",
                        //beforeSend: funcBefore,
                        success: function (answer) {
                            var like = document.getElementById(post_id + "like");
                            var dislike = document.getElementById(post_id + "dislike");

                            var count_likes = parseFloat(document.getElementById(post_id + "clike").innerHTML);
                            var count_dislikes = parseFloat(document.getElementById(post_id + "cdislike").innerHTML);

                            if (answer === "add") {
                                dislike.style.color = "red";
                                count_dislikes++;
                            }
                            else if(answer === "subtract") {
                                dislike.style.color = "grey";
                                count_dislikes--;
                            }
                            else if(answer === "change"){
                                like.style.color = "grey";
                                dislike.style.color = "red";
                                count_likes--;
                                count_dislikes++;
                            }

                            document.getElementById(post_id + "clike").innerHTML = count_likes;
                            document.getElementById(post_id + "cdislike").innerHTML = count_dislikes;
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <div class="header dropdown-header table-dark">
            <div class="row">
                <form name="exit" action="/exit" method="post">
                    <input type="submit" name="exit" value="Exit" class="btn btn-outline-light btn-header">
                </form>
                <form name="changePassword" action="/password/change" method="post">
                    <input type="submit" name="changePassword" value="Change Password" class="btn btn-outline-light btn-header">
                </form>
                <form name="changeParameters" action="/parameters/change" method="post">
                    <input type="submit" name="changeParameters" value="Change Parameters" class="btn btn-outline-light btn-header">
                </form>
            </div>
        </div><br><br>
        <div class="content">
            <div class="column">
                <div class="card">
                    <a href="/avatar/change" class="avatar-link">
                        <div class="avatar-container">
                            <img id="output" alt="Avatar" src="<?=$user["avatar"];?>" class="avatar"/>
                            <div class="overlay">
                                <div class="text">Change Avatar</div>
                            </div>
                        </div>
                    </a>
                    <span class="hello"><?=$user['name'];?></span>
                    <br>
                    <form action="/post/add" method="post">
                        <input type="submit" name="add_post" value="Add post" class="btn btn-primary btn-post">
                    </form>
                </div>
            </div>
            <?php function printResult ($select_posts,$user_id) {
                while (($row = $select_posts->fetch_assoc()) != false) { 
                    if ($row["count_dislikes"] == NULL) {
                        $row["count_dislikes"] = 0;
                    };
                    if ($row["count_likes"] == NULL) {
                        $row["count_likes"] = 0;
                    };
                    $like_result = Like::findResult($user_id,$row["id"]);?>
                <div class="column" id="column<?=$row["id"];?>">
                    <div class="card">
                        <h4 class="card-title">
                            <?=$row["title"]?>
                        </h4>

                        <p class="card-text">
                            <?=$row["description"]?>
                        </p>

                        <p class="card-text text-right" style="font-size:12px;">
                            <?=$row["name"]?>
                        </p>
                        <div class="row">
                            <button id="<?=$row['id'];?>like" name="<?=$row['id'];?>like" class="btn-like"  style="<?php
                                                                                if ($like_result == 1) {
                                                                                    echo "color:blue;";
                                                                                };
                                                                                ?>">
                                <i class="fas fa-thumbs-up"></i>
                                <span style="margin:0 5px;" id="<?=$row['id'];?>clike"><?=$row["count_likes"];?></span>
                            </button>
                            <button id="<?=$row['id'];?>dislike" name="<?=$row['id'];?>dislike" class="btn-dislike"  style="<?php
                                                                                if ($like_result != NULL && $like_result == 0) {
                                                                                    echo "color:red;";
                                                                                };
                                                                                ?>">
                                <i class="fas fa-thumbs-down"></i>
                                <span style="margin:0 5px;" id="<?=$row['id'];?>cdislike"><?=$row["count_dislikes"];?></span>
                            </button>
                        </div><br>
                        <?php   if ($row["user_id"] == $user_id) {?>
                        <div class="row">
                            <form action="/post/edit" method="post">
                                <input type="submit" name="<?=$row['id'];?>edit_post" value="Edit post" class="btn btn-success btn-post">
                            </form>
                            <form action="" method="post">
                                <input type="button" id="delete_post" name="<?=$row['id'];?>delete_post" value="Delete post" class="btn btn-danger btn-post delete">
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            <?php }} 
                printResult($select_posts,$user['id']);
            ?>
        </div>
    </body>
</html>