<?php

$target = filter_var($_GET["search"], FILTER_SANITIZE_NUMBER_INT);
$sortedArray = unserialize(file_get_contents("output.txt"));

$description = "";
foreach($sortedArray as $item) {
    if($item["id"] == $target) {
        $description = $item["desc"];
        break;
    }
}

echo $description;