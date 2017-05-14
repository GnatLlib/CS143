<!DOCTYPE html>
<html>
<body>
<head>
    <title> Actor Detail Page </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
</head>
<ul class="sidebar-nav">
                <li class = "sidebar-brand">
                    <a href="index.php">Home</a>
                </li>
                <li class = "sidebar-brand">
                    <a href="#">Search</a>
                </li>
                <li>
                    <form action='search.php' method = 'get'>
                    <input type = 'text' style= 'padding: 0px 10px;width:170px;' name='query'>
                    <input type = 'submit' style = 'margin-left: 20px; margin-top: 10px;' value = "Submit">
                    </form>
                </li>   
                <li class = "sidebar-brand">
                    <a href="#">Add Content</a>
                </li>
                <li>
                    <a href="addActorDirector.php">Actor/Director</a>
                </li>
                <li>
                    <a href="addMovie.php">Movie</a>
                </li>
                <li>
                    <a href="addActorMovie.php">Movie/Actor Relation</a>
                </li>
                <li>
                    <a href="addDirectorMovie.php">Movie/Director Relation</a>
                </li>
            </ul>
<?php

        $db_connection = mysql_connect("localhost", "cs143", "");
        mysql_select_db("CS143", $db_connection);
        $topsql = "SELECT title, imdb, rot, id FROM  Movie JOIN MovieRating ON id = mid ORDER BY (imdb+rot) DESC LIMIT 5";
        $trs = mysql_query($topsql, $db_connection);
        echo "<div class = 'container'>
        <h1> Welcome to the Movie Database </h1>
        <br>
        <p> Use the handy menu to search for actor/movies
        or add your own content </p>

        <br>
        <h3> Top Movies </h3>
        <table class = 'table'>
        <tr>
        <th> Title </th>
        <th> IMDB </th>
        <th> Rotten Tomatoes </th>
        </tr>";
        while($row = mysql_fetch_row($trs)){
            echo "<tr>
                <td> <a href= 'moviedetail.php?id=$row[3]'> $row[0] </a></td>
                <td> $row[1] </td>
                <td> $row[2] </td>
                </tr>";
        }
        

        echo "</table></div>";



        mysql_close($db_connection);

?>







</body>
</html>
