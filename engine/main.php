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
/*
 * add preapre sql query
 */
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
function print_table($data, $colour_array): void
{
    //$i = 1;
    echo "<table class='w3-table-all' style='width: 100%'>";
    echo "<tr>
            <!--<th class='w3-center' style='width: 2%'>ID</th>-->
            <th class='w3-center' style='width: 60%'>Description</th>
            <th class='w3-center' style='width: 30%'>Tags</th>
            <th class='w3-center' style='width: 8%'>Viewed/<br>Readed</th>
        </tr>";
    foreach ($data as $row) {
        echo "<tr>";
        /*echo "<td class='w3-center'>" . $i . "</td>";*/
        echo "<td><a href='" . $row['url'] . "'_target='_blank'>" . $row['description'] . "</a></td>";
        echo "<td>";
        foreach (split_tags($row['tags']) as $tag) {
            echo "<span class='w3-tag " . $colour_array[random_int(0, count($colour_array) - 1)] . "'>" . $tag . "</span> ";
        }
        echo "</td>";
        echo "<td class='w3-center'><input type='checkbox' ";
        if ($row['checked'] == 1) {
            echo "checked";
        };
        echo "></td>";
        /*echo "<td class='w3-center'><button>Edit</button></td>";
        echo "<td class='w3-center'><button>Delete</button></td>";*/
        echo "</tr>";
        //$i++;
    }
    echo "</table>";
}

//function splitting tags by #
function split_tags($tags): array
{
    return explode("#", $tags);
}

//function reading csv file and inserting data to database
function read_csv($file, $env_array): void
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

//function printing tags from database into table
function print_tags($db, $colour_array): void
{
    $sql = "select tags from main";
    $data = get_data($db, $sql);
    $tags = array();
    foreach ($data as $row) {
        foreach (split_tags($row['tags']) as $tag) {
            $tags[] = $tag;
        }
    }
    $tags = array_unique($tags);
    natcasesort($tags);
    foreach ($tags as $tag) {
        echo "<span style='display: inline-block'><input id='" . $tag . "' type='checkbox' checked class='w3-check'>";
        echo "<label for='" . $tag . "' class='w3-tag " . $colour_array[random_int(0, count($colour_array) - 1)] . "'>" . $tag . "</label></span> ";
    }
}

//read_csv('import.csv', $env_array);
?>