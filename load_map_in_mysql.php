<?php

require_once "functions.php";
require_once "config.php";
require_once "init.php";

$link = mysqli_connect($mysqlhost, $mysqluser, $mysqlpass, $mysqldb);
if (!$link) {
    die('Could not connect: '.mysql_error());
}
echo 'Connected successfully<br>';

$xmlmap = $mapfile;

$xml = simplexml_load_file($xmlmap);
$tilesets = load_tilesets_array($xml, $link);
$version = $xml->attributes()->version;
$tiledversion = $xml->attributes()->tiledversion;
$orientation = $xml->attributes()->orientation;
$renderorder = $xml->attributes()->renderorder;
$width = $xml->attributes()->width;
$htmlmapwidth = $width;
$height = $xml->attributes()->height;
$htmlmapheight = $height;
$tilewidth = $xml->attributes()->tilewidth;
$tileheight = $xml->attributes()->tileheight;
$nextobjectid = $xml->attributes()->nextobjectid;
$compression = $xml->layer->data->attributes()->compression;
$encoding = $xml->layer->data->attributes()->encoding;
$data = $xml->layer->data;
$data = parse_data($data, $encoding, $compression);
$chars = str_split($data);

$x = 1;
$y = 1;

for ($i = 0; $i < 3200; $i += 4) {
    $n = ($i / 4) + 1;
    $array32 = unpack("V", $data, $i);
    $tilenumber = $array32[1];

    $tile_id = $tilenumber + $firstgid;
    $imagepath = $tilesets[$tile_id];

    $tile_id = mysqli_real_escape_string($link, $tile_id);
    $sql = "INSERT INTO cell( c_x, c_y, c_tile_id, tooltip_base ) VALUES(".$x.",".$y.",".$tile_id.", 'not yet') ";
    if (!mysqli_query($link, $sql)) {
        echo "Error: ".$sql."<br>".mysqli_error($conn);
    } else {
        echo " . ";
    }

    if ($x == $width) {
        $y++;
        $x = 1;
    } else {
        $x++;
    }
}

echo "</table>";
