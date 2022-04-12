<?php

require_once ('env.php');
//function connect to database
function connect($config)
{
    $db = new mysqli($config['db_host'], $config['db_user'], $config["db_password"], $config['db_name']);
    if ($db->connect_errno) {
        die("Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error);
    }
    return $db;
}
//function to get data from database
//TODO poprawić zapytanie do bazy danych lub eksporu z bazy tak aby wyświeltło wszystkie dane dotyczące tagów dla danego wpisu
$sql = "SELECT * FROM tags_main join main m on m.id_main = tags_main.id_main join tags t on t.id_tags = tags_main.id_tags";
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
}?>
<pre><?php
print_r(get_data(connect($env_array), $sql));
?>
</pre>
