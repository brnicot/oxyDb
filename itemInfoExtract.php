<?php

$regexp = "/\[(\d*)\].*\sidentifiedDisplayName\s=\s\"(.*)\".*\sidentifiedResourceName\s=\s\"(.*)\".*\sidentifiedDescriptionName\s=\s\{(.*)}/sU";
$data = file_get_contents("itemInfo.lua");

$matches = [];
preg_match_all($regexp, $data, $matches);

$items = array();
foreach($matches[1] as $key => $match) {
    $desc = str_replace("\"", "", $matches[4][$key]);
    $desc = str_replace(",", " ", $desc);
    $desc = preg_replace(["/\^.{6}/sU"], [""], $desc);
    $desc = preg_replace('!\s{2,}!', "\n", $desc);
    $desc = trim($desc);

    $items[] = [
        "id" => utf8_encode($match),
        "name" => utf8_encode($matches[2][$key]),
        "resourceName" => utf8_encode($matches[3][$key]),
        "desc" => utf8_encode($desc)
    ];
}

echo file_put_contents("output.txt", serialize($items));
