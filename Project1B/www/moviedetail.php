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
        
        $sql = "SELECT * FROM Movie WHERE id = ". $_GET['id'];
        
        $rs = mysql_query($sql, $db_connection);
        while($row = mysql_fetch_row($rs)){
            $title = $row[1];
            $year = $row[2];
            $rating = $row[3];
            $company = $row[4];
        }
        $dirsql = "SELECT * FROM Director WHERE id = (SELECT did FROM MovieDirector WHERE mid = ". $_GET['id']. ")";
        $drs = mysql_query($dirsql, $db_connection);
        $drow = mysql_fetch_row($drs);
        $director = $drow[2] . ' ' .  $drow[1];
        
        $gensql = "SELECT genre FROM MovieGenre WHERE mid = ".$_GET['id'];
        $grs = mysql_query($gensql, $db_connection);
        $genre = '';
        while($grow = mysql_fetch_row($grs)){
            $genre = $genre . ' ' . $grow[0];
        }
        
        $actsql = "SELECT first, last, role, id FROM Actor JOIN MovieActor ON Actor.id = MovieActor.aid WHERE mid = ". $_GET['id'];
        $ars = mysql_query($actsql, $db_connection);
        
        $comsql = "SELECT * FROM Review WHERE mid =" . $_GET['id'];
        $crs = mysql_query($comsql, $db_connection);
        
        $avgsql = "SELECT AVG(rating) FROM Review WHERE mid =" . $_GET['id'];
        $avrs = mysql_query($avgsql, $db_connection);
        $avrow = mysql_fetch_row($avrs);
        $avg = $avrow[0];
        if ($avg === NULL){
            $avg = 'No Reviews';
        }
        $totsql = "SELECT COUNT(rating) FROM Review WHERE mid =" . $_GET['id'];
        $trs = mysql_query($totsql, $db_connection);
        $trow = mysql_fetch_row($trs);
        $tot = $trow[0];
        
        echo "<div class = 'container'>
            <h1> Movie Information </h1>
            <table class = 'table'>
            <tr>
            <th> Title </th> 
            <th> Producer </th>
            <th> MPAA Rating </th>
            <th> Director </th>
            <th> Genre </th>
            <th> Year </th>
            </tr>
            <tr>
            <td> $title </td>
            <td> $company </td>
            <td> $rating </td>
            <td> $director </td>
            <td> $genre </td>
            <td> $year </td>
            </tr>
            </table>";
        echo "<h1> Actors and Roles </h1>
            <table class = 'table'>
            <tr>
            <th> Actor/Actress </th>
            <th> Role </th>
            </tr>";
        while($arow = mysql_fetch_row($ars)){
                $name = $arow[0] . ' ' . $arow[1];
                $role = $arow[2];
                $id = $arow[3];
                echo "<tr>
                    <td> <a href = 'actordetail.php?id=$id'> $name </a> </td>
                    <td> $role </td>
                    </tr>";
                
            }
        echo "</table>";
        echo "<h1> User Review </h1>";
        if( $avg === 'No Reviews'){
        echo "<p> There are no user reviews for this movie yet</p>";
        
        }
        else{
        echo "<p> The average user rating for this movie is $avg/5 based on $tot reviews</p>";
        
        echo "<h3> Comment Details </h3>";
        while($crow = mysql_fetch_row($crs)){
            $name = $crow[0];
            $time = $crow[1];
            $rating = $crow[3];
            $comment = $crow[4];
            echo"<p> $name left the following comment with a rating of $rating/5 at $time: </p>
            <p> $comment </p>";
            echo "<br>";

        }


        }
        $movid = $_GET['id'];
        echo "<h3> Add a comment </h3><br>";
        echo "<form name='addComment' action='addComment.php?' method='GET'>
        Name: <input type='text' name='name' maxlength='20' value='Anonymous'><br>
        Your Rating: <select name='rating' class = 'styled'>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
        </select><br>
        Comment:<br>
        <textarea name='comment' cols='50' rows='10' class = 'styled'></textarea><br>
        <input type = 'hidden' name='movie_id' value=$movid>
        <input type='submit' value='Submit'>
    </form>";
        echo "</div>";
        
    ?>






<script src="js/bootstrap.min.js"></script>
</body>
</html>