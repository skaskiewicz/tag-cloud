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
    $i = 1;
    echo "<table class='w3-table-all' style='width: 100%'>";
    echo "<tr>
            <th class='w3-center' style='width: 2%'>ID</th>
            <th class='w3-center' style='width: 60%'>Description</th>
            <th class='w3-center' style='width: 30%'>Tags</th>
            <th class='w3-center' style='width: 8%'>Viewed/<br>Readed</th>
        </tr>";
    foreach ($data as $row) {
        echo "<tr class='filterTag";
        foreach (split_tags($row['tags']) as $tag) {
            echo " " . $tag;
        }
        echo "'>";
        echo "<td class='w3-center'>" . $i . "</td>";
        echo "<td><a href='" . $row['url'] . "' target='_blank'>" . $row['description'] . "</a></td>";
        echo "<td>";
        foreach (split_tags($row['tags']) as $tag) {
            echo "<span class='w3-tag " . $colour_array[random_int(0, count($colour_array) - 1)] . "'>" . $tag . "</span> ";
        }
        echo "</td>";
        echo "<td class='w3-center'><input type='checkbox' ";
        if ($row['checked'] == 1) {
            echo "checked";
        }
        echo "></td>";
        /*echo "<td class='w3-center'><button>Edit</button></td>";
        echo "<td class='w3-center'><button>Delete</button></td>";*/
        echo "</tr>";
        $i++;
    }
    echo "</table>";
}

//function splitting tags by #
function split_tags($tags): array
{
    return explode("#", $tags);
}

//function reading csv file and inserting data to database
//TODO: add array for mapping columns from csv file to database
function read_csv($file, $env_array): array
{
    //open file
    $file = fopen($file, "r");
    $db = connect($env_array);
    $sql_url = "SELECT url FROM main";
    //get urls from database
    $urls = get_data($db, $sql_url);
    //delete unnecessary characters from urls in database
    for ($i = 0; $i < count($urls); $i++) {
        $urls[$i]['url'] = preg_replace("/^(http(s)?:\/\/|ftp(s)?:\/\/)?(www\.)?/i", "", $urls[$i]['url']);
    }
    //array for existing urls from file
    $url_exist = array();
    while (!feof($file)) {
        $line = fgetcsv($file, 0, ";");
        //delete unnecessary characters from url before check if it exists in database
        $url = preg_replace("/^(http(s)?:\/\/|ftp(s)?:\/\/)?(www\.)?/i", "", preg_replace("/\/$/", "", $line[2]));
        //check if url exists in database. if not, insert it
        if (!search_in_array($url, $urls, 'url')) {
            //TODO: ustalić kolejność kolumn w pliku csv (zapewne: tags;description;url)
            $sql = "insert into main (tags, description, url, checked) values ('" . strtolower($line[0]) . "', '" . $line[1] . "', '" . preg_replace("/\/$/", "", $line[2]) . "', '0')";
            $db->query($sql);
        } else {
            //else, add url to array for future alert
            $url_exist[] = $url;
        }
    }
    fclose($file);
    //return array with urls that exists in database
    return $url_exist;
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
        echo "<span style='display: inline-block'><input id='" . $tag . "' type='checkbox' checked class='w3-check' onclick=\"filter_tag('" . $tag . "')\">";
        echo "<label for='" . $tag . "' class='w3-tag " . $colour_array[random_int(0, count($colour_array) - 1)] . "'>" . $tag . "</label></span> ";
    }
}

//serach in multidimensional array with case insensitive/sensitive search
function search_in_array($search, $array, $field, $case_insensitive = true): bool
{
    foreach ($array as $key => $value) {
        //if case insensitive search, convert to lowercase
        if ($case_insensitive) {
            if (strtolower($value[$field]) == strtolower($search)) {
                //if found, return true
                return true;
            }
        } else {
            //else, search as is
            if ($value[$field] == $search) {
                //if found, return true
                return true;
            }
        }
    }
    //if not found, return false
    return false;
}
//read_csv('import.csv', $env_array);
?>