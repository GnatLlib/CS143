<!DOCTYPE html>
<html>
<head>
    <title> Thanks </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
</head>
<body>
    <div class = 'container'>
    <h3> Thank you for your review </h3>
    <p> You will be redirected shortly </p>
    <?php
        $name = mysql_escape_string(trim($_GET["name"]));
        $movie_id = $_GET["movie_id"];
        $rating = $_GET["rating"];
        $comment = mysql_escape_string(trim($_GET["comment"]));
        
        if($movie_id != "" && $rating != ""){
            if($name == "")
                $name = "Anonymous";

            $db_connection = mysql_connect("localhost", "cs143", "");
            mysql_select_db("CS143", $db_connection);

            if($comment == "")
                $query = "INSERT INTO Review VALUES('$name', date('Y-m-d H:i:s'), $movie_id, $rating, NULL);";
            else
                $query = "INSERT INTO Review VALUES('$name', date('Y-m-d H:i:s'), $movie_id, $rating, '$comment');";
            $rs = mysql_query($query, $db_connection) or exit(mysqlerror());
            mysql_close($db_connection);
        }

        header("refresh:5; url=moviedetail.php?id=$movie_id");
    ?>
    </div<
</body>
</html>