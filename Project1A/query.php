<!DOCTYPE html>
<html>
<body>

<h1>Enter Query in Text Box</h1>
<form method="get" id = 'queryform'>
<textarea rows = "4" cols = '50' name = 'query' form = 'queryform'> </textarea>
<input type="submit">
</form>
<?php

    $db_connection = mysql_connect("localhost", "cs143", "");
    mysql_select_db("CS143", $db_connection);
    $columns = 0;
    if ($_GET['query']){
        $query = $_GET['query'];
        $rs = mysql_query($query, $db_connection);
        $columns = mysql_num_fields($rs);
        echo "<table border = '1'>";
        echo "<tr>";
        for ($x = 0; $x < $columns; $x++){
            echo "<th>";
            echo mysql_field_name ($rs, $x);
            echo "</th>";
        }
        echo "</tr>"; 
        while($row = mysql_fetch_row($rs)){
            echo "<tr>";
            for ($i = 0; $i < $columns; $i++){
            echo "<td>";
            echo $row[$i];
            echo "</td>";
            }
            echo "</tr>";
        
        }
        echo "</table>";   
        
    }
    
    mysql_close($db_connection);
    
    
?>
</body>
</html>