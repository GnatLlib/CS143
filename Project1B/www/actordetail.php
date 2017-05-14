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
        
        $sql = "SELECT * FROM Actor WHERE id = ". $_GET['id'];
        
        $rs = mysql_query($sql, $db_connection);
        while($row = mysql_fetch_row($rs)){
            $name = $row[2] . ' ' . $row[1];
            $sex = $row[3];
            $dob = $row[4];
            $dod = $row[5];
            if (is_null($row[5])){
                $dod = "Still Alive";
                
            }

        }
        $rolesql = "SELECT * FROM MovieActor WHERE aid = " . $_GET['id'];
        $rrs = mysql_query($rolesql, $db_connection);
        echo "<div class = 'container'>";
        echo "<h1> Actor Information </h1>";
        echo "<table class = 'table'>";
        echo "<tr>";
        echo "<th> Name </th> <th> Sex </th> <th> Date of Birth </th> 
        <th> Date of Death </th>";
        echo "</tr>";
        echo "<tr>
              <td> $name </td>
              <td> $sex </td>
              <td> $dob </td>
              <td> $dod </td>
              </tr>";
        echo "</table>";
        echo "<h1> Movie Roles </h1>";
        echo "<table class = 'table'>";
        echo "<tr>
                <th> Movie Title </th>
                <th> Role </th>
            </tr>";
         while($row = mysql_fetch_row($rrs)){
            $moviesql = "SELECT * FROM Movie WHERE id = " . $row[0];
            $mrs = mysql_query($moviesql, $db_connection);
            $mrow = mysql_fetch_row($mrs);
            $title = $mrow[1];
            $link = "<a href='moviedetail.php?id=" . $row[0] . "'>" . $title
            . "</a>";
            echo "<tr>";
            echo "<td>";
            echo $link;
            echo "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "</tr>";
        
        }
        echo "</tabel>";
        echo "</div>";
        

        mysql_close($db_connection);

?> 







 
 <script src="js/bootstrap.min.js"></script>

</body>
</html>
