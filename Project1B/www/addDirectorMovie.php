<!DOCTYPE html>
<html>
<head>
    <script>
        function validate(){
            var movie_id = document.forms["addDirectorMovie"]["movie_id"].value;
            var director_id = document.forms["addDirectorMovie"]["director_id"].value;
            
            if(movie_id == "" || movie_id == null){
                alert("Movie empty or invalid");
                return false;
            }
            
            if(director_id == "" || director_id == null){
                alert("Director empty or invalid");
                return false;
            }
            
            alert("Adding director / movie relation");
            return true;
        }
    </script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <title> Add Director Movie Relation </title>
</head>
<body>
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

    <div class = 'container'>
    <h1> Add Director Movie Relation </h1>
    <br>
    <form name="addDirectorMovie" action="#" method="GET" onsubmit="return validate()">
        Movie Title: <br><select name="movie_id">
            <?php
                $db_connection = mysql_connect("localhost", "cs143", "");
                mysql_select_db("CS143", $db_connection);

                $query = "SELECT id, title, year FROM Movie ORDER BY title;";
                $rs = mysql_query($query, $db_connection) or exit(mysqlerror());
                while($row = mysql_fetch_row($rs))
                    echo "<option value=\"$row[0]\">$row[1] ($row[2])</option>";
                mysql_free_result($rs);
            ?>
        </select><br><br>
        Director: <br><select name="director_id">
            <?php
                $db_connection = mysql_connect("localhost", "cs143", "");
                mysql_select_db("CS143", $db_connection);

                $query = "SELECT id, first, last, dob FROM Director ORDER BY first, last, id;";
                $rs = mysql_query($query, $db_connection) or exit(mysqlerror());
                while($row = mysql_fetch_row($rs))
                    echo "<option value=\"$row[0]\">$row[1] $row[2] ($row[3])</option>";
                mysql_free_result($rs);
            ?>
        </select><br><br>
        <input type="submit" value="Submit">
    </form>
    <?php
        $movie_id = $_GET["movie_id"];
        $director_id = $_GET["director_id"];
        
        if($movie_id != "" && $director_id != ""){
            $db_connection = mysql_connect("localhost", "cs143", "");
            mysql_select_db("CS143", $db_connection);

            $query = "INSERT INTO MovieDirector VALUES($movie_id, $director_id);";

            $rs = mysql_query($query, $db_connection) or exit(mysqlerror());
            mysql_close($db_connection);
        }
    ?>
    </div>
</body>
</html>