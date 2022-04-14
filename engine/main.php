<?php
require_once('env.php');
//function connect to database
function connect($env_array)
{
    $db = new mysqli($env_array['db_host'], $env_array['db_user'], $env_array["db_password"], $env_array['db_prefix'] . $env_array['db_name']);
    if ($db->connect_errno) {
        die("Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error);
    }
    //set charset for connection with database
    mysqli_set_charset($db, "utf8");
    return $db;
}

//function to get data from database
$sql = "select id_main, description, url, tags, checked from main";
function get_data($db, $sql)
{
    $result = $db->query($sql);
    if (!$result) {
        die("Error: " . $db->error);
    }
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

//print html table with data from database
function print_table($data)
{
    $i = 1;
    echo "<table>";
    echo "<tr><th>ID</th><th>Description</th><th>Tags</th><th>Viewev/Readed</th></tr>";
    foreach ($data as $row) {
        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td><a href='" . $row['url'] . "' target='_blank'>" . $row['description'] . "</a></td>";
        echo "<td>";
        foreach (split_tags($row['tags']) as $tag) {
            echo $tag . " ";
        }
        echo "</td>";
        echo "<td><input type='checkbox' ";
        if ($row['checked'] == 1) {
            echo "checked";
        };
        echo "></td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
}

//function splitting tags by #
function split_tags($tags)
{
    $tags = explode("#", $tags);
    return $tags;
}

//function reading csv file and inserting data to database
function read_csv($file, $env_array)
{
    $file = fopen($file, "r");
    $db = connect($env_array);
    while (!feof($file)) {
        $line = fgetcsv($file, 0, ";");
        //TODO: ustalić kolejność kolumn w pliku csv (zapewne: tags;description;url)
        $sql = "insert into main (tags, description, url, checked) values ('" . $line[0] . "', '" . $line[1] . "', '" . $line[2] . "', '0')";
        $db->query($sql);
    }
    fclose($file);
}


//read_csv('import.csv', $env_array);
print_table(get_data(connect($env_array), $sql));
?>