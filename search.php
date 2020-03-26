<?php

$target = filter_var($_GET["search"], FILTER_SANITIZE_STRING);
$sortedArray = unserialize(file_get_contents("output.txt"));

foreach($sortedArray as $item) {
    if(stripos($item["name"], $target) !== false) {
        $results[] = array("id" => $item["id"], "text" => $item["name"]);
    }
}

echo json_encode($results);
