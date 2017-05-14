<!DOCTYPE html>
<html>
<head>
    <script>
        function validate(){
            var title = document.forms["addMovie"]["title"].value;
            var year = document.forms["addMovie"]["year"].value;
            var company = document.forms["addMovie"]["company"].value;
            
            title = title.trim();
            company = company.trim();
            
            if(title == "" || title == null){
                alert("Title empty or invalid");
                return false;
            }
            
            if(company == "" || company == null){
                alert("Company empty or invalid");
                return false;
            }
            
            if(year == ""  || year == null || year.match(/[^0-9]/g) != null || parseInt(year, 10) > 3000 || parseInt(year, 10) < 1000){
                alert("Year empty or invalid");
                return false;
            }
            
            alert("Adding movie");
            return true;
        }
    </script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <title> Add Movie </title>
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
    <div class= 'container'>
        <h1> Add Movie </h1>
        <br>
    <form name="addMovie" action="#" method="GET" onsubmit="return validate()">
        Title: <input type="text" name="title" maxlength="100" class='styled'><br>
        Year: <input type="text" name="year" maxlength="4" class = 'styled'><br>
        Rating: <select name="rating" class= 'styled'>
            <option value="G">G</option>
            <option value="NC-17">NC-17</option>
            <option value="PG">PG</option>
            <option value="PG-13">PG-13</option>
            <option value="R">R</option>
            <option value="surrendere">surrendere</option>
        </select><br>
        Company: <input type="text" name="company" maxlength="50" class = 'styled'><br>
        <br>
        Genre(s):
            <input type="checkbox" name="genre[]" value="Action">Action
            <input type="checkbox" name="genre[]" value="Adult">Adult
            <input type="checkbox" name="genre[]" value="Adventure">Adventure
            <input type="checkbox" name="genre[]" value="Animation">Animation
            <input type="checkbox" name="genre[]" value="Comedy">Comedy
            <input type="checkbox" name="genre[]" value="Crime">Crime
            <input type="checkbox" name="genre[]" value="Documentary">Documentary
            <input type="checkbox" name="genre[]" value="Drama">Drama
            <input type="checkbox" name="genre[]" value="Family">Family
            <input type="checkbox" name="genre[]" value="Fantasy">Fantasy
            <input type="checkbox" name="genre[]" value="Horror">Horror
            <input type="checkbox" name="genre[]" value="Musical">Musical
            <input type="checkbox" name="genre[]" value="Mystery">Mystery
            <input type="checkbox" name="genre[]" value="Romance">Romance
            <input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi
            <input type="checkbox" name="genre[]" value="Short">Short
            <input type="checkbox" name="genre[]" value="Thriller">Thriller
            <input type="checkbox" name="genre[]" value="War">War
            <input type="checkbox" name="genre[]" value="Western">Western
        <br>
        <input type="submit" value="Submit" class = 'styled'>
    </form>
    <?php
        $title = mysql_escape_string(trim($_GET["title"]));
        $year = $_GET["year"];
        $rating = $_GET["rating"];
        $company = mysql_escape_string(trim($_GET["company"]));
        $genre = $_GET["genre"];

        if($title != "" && $year != "" && $company != ""){
            $db_connection = mysql_connect("localhost", "cs143", "");
            mysql_select_db("CS143", $db_connection);

            $rs = mysql_query("UPDATE MaxMovieID SET id = id + 1;", $db_connection) or exit(mysqlerror());
            $rs = mysql_query("SELECT id FROM MaxMovieID;", $db_connection) or exit(mysqlerror());
            $row = mysql_fetch_row($rs);
            $new_id = $row[0];

            $query = "INSERT INTO Movie VALUES($new_id, '$title', $year, '$rating', '$company');";

            $rs = mysql_query($query, $db_connection) or exit(mysqlerror());

            for($i = 0; $i < count($genre); $i++){
                $query = "INSERT INTO MovieGenre VALUES($new_id, '$genre[$i]');";
                $rs = mysql_query($query, $db_connection) or exit(mysqlerror());
            }

            mysql_close($db_connection);
        }
    ?>
    </div>
</body>
</html>