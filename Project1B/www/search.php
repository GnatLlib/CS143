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

        $isfirst = 1;
        $actorsql = "SELECT first, last, dob,id FROM Actor WHERE";
        $moviesql = "SELECT title, year, id FROM Movie WHERE";
        $querystrings = explode(" ", $_GET['query']);
       
        foreach($querystrings as $s){
            if($isfirst === 0){
                $actorsql = $actorsql . "AND";
                $moviesql = $moviesql . "AND";
            }
            $actorsql = $actorsql . "(first LIKE '%$s%' or last LIKE '%$s%')";
            $moviesql = $moviesql . "(title LIKE '%$s%')";
            $isfirst = 0;
            
            
        }
        $ars = mysql_query($actorsql, $db_connection);
        $mrs = mysql_query($moviesql, $db_connection);
        
       
        echo "<div class = 'container'>
        <h1> Search Results </h1>
        <br>
        <h2> Actors/Actresses </h2>";
        echo "<table class = 'table'>
            <tr>
            <th> Name </th>
            <th> Date of Birth </th>
            </tr>";
        while($row = mysql_fetch_row($ars)){
            echo "<tr>
                <td> <a href = 'actordetail.php?id=$row[3]'> $row[0] $row[1] </a></td>
                <td> $row[2] </td>
                </tr>";
        }


        echo "</table>";
        echo "<h2> Movie </h2>";
         echo "<table class = 'table'>
            <tr>
            <th> Title </th>
            <th> Year </th>
            </tr>";
        while($row = mysql_fetch_row($mrs)){
            echo "<tr>
                <td> <a href = 'moviedetail.php?id=$row[2]'> $row[0]</a></td>
                <td> $row[1] </td>
                </tr>";
        }

        echo "</table>";
        mysql_close($db_connection);
        ?>




</body>
</html>