<html>
    <head>
        <title>Թմbook</title>
        <link   rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
                                 integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
                                 crossorigin="anonymous">
        <link href="/fontawesome/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/styles.css">
        <style>
            .btn-like:hover{
                border-bottom: 2px solid white;
            }
            .btn-dislike:hover{
                border-bottom: 2px solid white;
            }
        </style>
    </head>
    <body>
        <div class="header dropdown-header table-dark">
            <div class="row">
                <form name="login" action="/login" method="post">
                    <input type="submit" name="login" value="Log in" class="btn btn-outline-light btn-header">
                </form>
                <form action="/register" name="register" method="post">
                    <input type="submit" name="register" value="Register" class="btn btn-outline-light btn-header">
                </form>
            </div>
        </div><br><br>
        <div class="content">
            <?php function printResult ($select_posts) {
                while (($row = $select_posts->fetch_assoc()) != false) { 
                    if ($row["count_dislikes"] == NULL) {
                        $row["count_dislikes"] = 0;
                    };
                    if ($row["count_likes"] == NULL) {
                        $row["count_likes"] = 0;
                    };?>
                <div class="column">
                    <div class="card">
                        <h4 class="card-title">
                            <?=$row["title"]?>
                        </h4>

                        <p class="card-text">
                            <?=$row["description"]?>
                        </p>

                        <p class="card-text text-right" style="font-size:12px;">
                            <?=$row["name"]?>
                        </p><br>
                        <div class="row">
                            <button id="<?=$row['id'];?>like" name="<?=$row['id'];?>like" class="btn-like" disabled>
                                <i class="fas fa-thumbs-up"></i>
                                <span style="margin:0 5px;" id="<?=$row['id'];?>clike"><?=$row["count_likes"];?></span>
                            </button>
                            <button id="<?=$row['id'];?>dislike" name="<?=$row['id'];?>dislike" class="btn-dislike" disabled>
                                <i class="fas fa-thumbs-down"></i>
                                <span style="margin:0 5px;" id="<?=$row['id'];?>cdislike"><?=$row["count_dislikes"];?></span>
                            </button>
                        </div><br>
                    </div>
                </div>
            <?php }} 
                printResult($select_posts);
            ?>
        </div>
    </body>
</html>