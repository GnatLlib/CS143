<!DOCTYPE html>
<html>
<head>
    <script>
        function validate(){
            var role = document.getElementsByName("role");
            var last = document.forms["addActorDirector"]["last"].value;
            var first = document.forms["addActorDirector"]["first"].value;
            var dob = document.forms["addActorDirector"]["dob"].value;
            var dod = document.forms["addActorDirector"]["dod"].value;
            
            last = last.trim();
            first = first.trim();
            
            if(last == "" || last == null){
                alert("Last name empty or invalid");
                return false;
            }
            
            if(first == "" || first == null){
                alert("First name empty or invalid");
                return false;
            }
            
            if(dob.length != 8 || dob == null || dob.match(/[^0-9]/g) != null || parseInt(dob.substr(4, 2), 10) > 12 || parseInt(dob.substr(4, 2), 10) < 1 || parseInt(dob.substr(6, 2), 10) > 31 || parseInt(dob.substr(6, 2), 10) < 1){
                alert("Date of birth empty or invalid");
                return false;
            }
            
            if(dod != ""){
                if(dod.length != 8 || dod == null || dod.match(/[^0-9]/g) != null || parseInt(dod.substr(4, 2), 10) > 12 || parseInt(dod.substr(4, 2), 10) < 1 || parseInt(dod.substr(6, 2), 10) > 31 || parseInt(dod.substr(6, 2), 10) < 1){
                    alert("Date of death invalid");
                    return false;
                }
            }
            
            if(role[0].checked)
                alert("Adding actor");
            else
                alert("Adding director");
            
            return true;
        }
    </script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <title> Add Actor/Director </title>
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
        <h1> Add Actor or Director </h1>
        <br>
    <form name="addActorDirector" action="#" method="GET" onsubmit="return validate()">
        Role: <input type="radio" name="role" value="Actor" checked>Actor <input type="radio" name="role" value="Director" checked>Director<br>
        Last Name: <input type="text" name="last" maxlength="20" class = 'styled'><br>
        First Name: <input type="text" name="first" maxlength="20" class = 'styled'><br>
        Sex: <input type="radio" name="sex" value="Male" checked>Male <input type="radio" name="sex" value="Female" checked>Female<br>
        Date of Birth: <input type="text" class = 'styled' name="dob" maxlength="8" placeholder="YYYYMMDD"><br>
        Date of Death (optional): <input type="text" class = 'styled' name="dod" maxlength="8" placeholder="YYYYMMDD"><br>
        <input type="submit" value="Submit">
    </form>
    <?php
        $role = $_GET["role"];
        $last = mysql_escape_string(trim($_GET["last"]));
        $first = mysql_escape_string(trim($_GET["first"]));
        $sex = $_GET["sex"];
        $dob = $_GET["dob"];
        $dod = $_GET["dod"];

        if($last != "" && $first != "" && $dob != ""){
            $db_connection = mysql_connect("localhost", "cs143", "");
            mysql_select_db("CS143", $db_connection);

            $rs = mysql_query("UPDATE MaxPersonID SET id = id + 1;", $db_connection) or exit(mysqlerror());
            $rs = mysql_query("SELECT id FROM MaxPersonID;", $db_connection) or exit(mysqlerror());
            $row = mysql_fetch_row($rs);
            $new_id = $row[0];

            if($role == "Actor"){
                if($dod == "")
                    $query = "INSERT INTO Actor VALUES($new_id, '$last', '$first', '$sex', '$dob', NULL);";
                else
                    $query = "INSERT INTO Actor VALUES($new_id, '$last', '$first', '$sex', '$dob', '$dod');";
            }
            else{
                if($dod == "")
                    $query = "INSERT INTO Director VALUES($new_id, '$last', '$first', '$dob', NULL);";
                else
                    $query = "INSERT INTO Director VALUES($new_id, '$last', '$first', '$dob', '$dod');";
            }

            $rs = mysql_query($query, $db_connection) or exit(mysqlerror());
            mysql_close($db_connection);
        }
    ?>
    </div>
</body>
</html>