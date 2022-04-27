<?php
require_once('./engine/main.php');
require_once('./engine/env.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tag cloud</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="./engine/w3.css" type="text/css"/>
    <style>
        div.sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            z-index: 1;
        }
        .top {
            --offset: 50px;

            position: sticky;
            bottom: 10px;
            margin-left: 90%;
            place-self: end;
            margin-top: calc(100vh + var(--offset));

            /* visual styling */
            text-decoration: none;
            padding: 10px;
            font-family: sans-serif;
            color: #fff;
            background: #000;
            white-space: nowrap;
        }
    </style>
</head>
<body>
<div id="home">
    <div id="cloud_tags" class="w3-container w3-padding-small w3-light-gray sticky">
        <?php
        print_tags(connect($env_array), $colour_array);
        ?>
    </div>
    <div id="top" class="w3-container w3-padding-16">
        <input type="file" id="file" name="file" accept="text/csv"/>
        <button class="w3-button w3-green"><i class="fa-solid fa-file-circle-plus"></i> Add from file</button>
    </div>

    <?php
    $sql = "select id_main, description, url, tags, checked from main";
    print_table(get_data(connect($env_array), $sql), $colour_array);
    ?>
    <!--
    pagination and other stuff
        <div id="pagination" class="w3-container">paginacja</div>
        <div id="footer" class="w3-container">stopka</div>
    -->
    <a href="#" class="top">&nbsp;&nbsp;<i class="fa-solid fa-angles-up"></i>&nbsp;&nbsp;</a>
</div>

</body>
</html>
