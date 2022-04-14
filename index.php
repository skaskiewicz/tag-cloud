<?php
require_once ('./engine/main.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tag cloud</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./engine/addons.css" type="text/css">
    <link rel="stylesheet" href="./engine/w3.css" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="home">
    <div id="cloud_tags" class="w3-container w3-padding-small w3-light-gray sticky">
        <input type="checkbox" class="w3-check">
        <label class="w3-tag w3-blue">tagi</label>
        <input type="checkbox" class="w3-check">
        <label class="w3-tag w3-red">tagi</label>
        <input type="checkbox" class="w3-check">
        <label class="w3-tag w3-green">tagi</label>
        <input type="checkbox" class="w3-check">
        <label class="w3-tag w3-yellow">tagi</label>
        <input type="checkbox" class="w3-check">
        <label class="w3-tag w3-orange">tagi</label>
        <input type="checkbox" class="w3-check">
        <label class="w3-tag w3-blue">tagi</label>
        <input type="checkbox" class="w3-check">
        <label class="w3-tag w3-red">tagi</label>
        <input type="checkbox" class="w3-check">
        <label class="w3-tag w3-green">tagi</label>
        <input type="checkbox" class="w3-check">
        <label class="w3-tag w3-yellow">tagi</label>
        <input type="checkbox" class="w3-check">
        <label class="w3-tag w3-orange">tagi</label>
    </div>
    <div id="top" class="w3-container w3-padding-16">
        <input type="file" id="file" name="file" accept="text/csv"/>
        <button class="w3-button w3-green"><i class="fa-solid fa-file-circle-plus"></i> Add from file</button>
    </div>
    <?php
    print_table(get_data(connect($env_array), $sql));
    ?>
<!--
    <div id="pagination" class="w3-container">paginacja</div>
    <div id="footer" class="w3-container">stopka</div>
-->
</div>
</body>
</html>
