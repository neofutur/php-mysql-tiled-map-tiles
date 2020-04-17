<?php

require_once "functions.php";
require_once "config.php";
require_once "init.php";

$xmlmap = $mapfile;

$xml = simplexml_load_file($xmlmap);

echo '<h2>map data</h2>';
echo "mapfile : ".$mapfile."<br>";

var_dump($xml);

$version = $xml->attributes()->version;
echo "version = ".$version."<br>";
$tiledversion = $xml->attributes()->tiledversion;
echo "tiledversion = ".$tiledversion."<br>";
$orientation = $xml->attributes()->orientation;
echo "orientation = ".$orientation."<br>";
$renderorder = $xml->attributes()->renderorder;
echo "renderorder=".$renderorder."<br>";
$width = $xml->attributes()->width;
echo "width = ".$width."<br>";
$htmlmapwidth = $width;
$height = $xml->attributes()->height;
echo "height = ".$height."<br>";
$htmlmapheight = $height;
$tilewidth = $xml->attributes()->tilewidth;
echo " tilewidth = ".$tilewidth."<br>";
$tileheight = $xml->attributes()->tileheight;
echo "tileheight = ".$tileheight."<br>";
$nextobjectid = $xml->attributes()->nextobjectid;
echo "nextobjectid= ".$nextobjectid."<br><br>";
$compression = $xml->layer->data->attributes()->compression;
$compression = strtolower($compression);
$encoding = $xml->layer->data->attributes()->encoding;
echo "compression= ".$compression." ";
echo "encoding= ".$encoding."<br>";
$data = $xml->layer->data;
echo $data;
$data = parse_data($data, $encoding, $compression);
echo "<br>";
var_dump($data);

$tilesetsmapcode = "<table><tr>";

$tilesets = $xml->tileset;

for ($i = 0; $i < count($tilesets); $i++) {
    echo "<br><br><b>Tileset Source: </b> ".$tilesets[$i]->attributes()->source."    ";
    $firstgid = $tilesets[$i]->attributes()->firstgid;
    echo 'firstgid : '.$firstgid.'    ';

    $filetileset = "map/".$tilesets[$i]->attributes()->source;
    $xmltileset = simplexml_load_file($filetileset);
    $tname = $xmltileset->attributes()->name;
    echo " name = ".$tname;
    $twidth = $xmltileset->attributes()->tilewidth;
    echo " width = ".$twidth;
    $theight = $xmltileset->attributes()->tileheight;
    echo " height = ".$theight;
    $tcount = $xmltileset->attributes()->tilecount;
    echo " count = ".$tcount;
    $tcolumns = $xmltileset->attributes()->columns;
    echo " columns = ".$tcolumns."<br>";
    $tiles = $xmltileset->tile;
    $htmltileset = "<table><tr>";
    for ($ii = 0; $ii < count($tiles); $ii++) {
        $tile = $tiles[$ii];
        $image = $tile->image;
        $isource = $image->attributes()->source;
        $iwidth = $image->attributes()->width;
        $iheight = $image->attributes()->height;
        if ($tiles[$ii]->properties) {
            $tooltip_base = $tiles[$ii]->properties->property->attributes()->value;
        }
        $tile_id = $tiles[$ii]->attributes()->id;
        $tile_id = $tile_id + $firstgid;
        echo "<br> TileId = ".$tile_id." ";
        echo "source = ".$isource."  ";
        echo "width = ".$iwidth." ";
        echo "height = ".$iheight."  | ";
        $htmltileset .= "<td><img title='".$tooltip_base."' src=".$isource."></td>";
    }
    $htmltileset .= "</tr></table>";
    $tilesetsmapcode .= $htmltileset;
    echo $htmltileset;
    $tilesetsmapcode .= "<br><br>";
}
echo "<br><br><b> all tiles  : </b><br><br>";
echo $tilesetsmapcode;
