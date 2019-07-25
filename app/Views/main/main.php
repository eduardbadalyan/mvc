<html>
    <head>
        <title>Թմbook</title>
        <link   rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
                                 integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
                                 crossorigin="anonymous">
        <link rel="stylesheet" href="/style.css">

    </head>
    <body>
        <div class="header dropdown-header table-dark">
            <div class="row">
            </div>
        </div><br><br>
        <div class="content">
            <?php function printResult ($select_posts) {
                while (($row = $select_posts->fetch_assoc()) != false) { ?>
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
                    </div>
                </div>
            <?php }} 
                printResult($select_posts);
            ?>
        </div>
    </body>
</html>