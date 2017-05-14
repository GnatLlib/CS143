<!DOCTYPE html>
<html>
<head>
    <script>
        function validate(){
            var movie_id = document.forms["addActorMovie"]["movie_id"].value;
            var actor_id = document.forms["addActorMovie"]["actor_id"].value;
            var role = document.forms["addActorMovie"]["role"].value;
            
            role = role.trim();
            
            if(movie_id == "" || movie_id == null){
                alert("Movie empty or invalid");
                return false;
            }
            
            if(actor_id == "" || actor_id == null){
                alert("Actor empty or invalid");
                return false;
            }
            
            if(role == "" || role == null){
                alert("Role empty or invalid");
                return false;
            }
            
            alert("Adding actor / movie relation");
            return true;
        }
    </script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <title> Add Actor Movie Relation </title>
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
            </ul>li>
            </ul>
        
        <div class = 'container'>
            <h1> Add Actor Movie Relation </h1>
            <br>
       <form name="addActorMovie" action="#" method="GET" onsubmit="return validate()">
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
        Actor: <br><select name="actor_id">
            <?php
                $db_connection = mysql_connect("localhost", "cs143", "");
                mysql_select_db("CS143", $db_connection);

                $query = "SELECT id, first, last, dob FROM Actor ORDER BY first, last, id;";
                $rs = mysql_query($query, $db_connection) or exit(mysqlerror());
                while($row = mysql_fetch_row($rs))
                    echo "<option value=\"$row[0]\">$row[1] $row[2] ($row[3])</option>";
                mysql_free_result($rs);
            ?>
        </select><br><br>
        Role: <input type="text" name="role" maxlength="50"><br>
        <input type="submit" value="Submit" class ='styled'>
    </form>
    <?php
        $movie_id = $_GET["movie_id"];
        $actor_id = $_GET["actor_id"];
        $role = mysql_escape_string(trim($_GET["role"]));
    
        if($movie_id != "" && $actor_id != "" && $role != ""){
            $db_connection = mysql_connect("localhost", "cs143", "");
            mysql_select_db("CS143", $db_connection);

            $query = "INSERT INTO MovieActor VALUES($movie_id, $actor_id, '$role');";

            $rs = mysql_query($query, $db_connection) or exit(mysqlerror());
            mysql_close($db_connection);
        }
    ?>
</body>
</html>