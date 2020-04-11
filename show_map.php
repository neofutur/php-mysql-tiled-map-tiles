<?php

require_once("functions.php");
require_once("config.php");
require_once("init.php");

//$xmlmap="/home/agame/public_html/map/agame_v1.tmx";
//$xmlmap="map/agame_v1.tmx";
$xmlmap=$mapfile;

$xml = simplexml_load_file($xmlmap);
$tilesets = load_tilesets_array($xml);
$tooltips= load_tooltips_array($xml);
//var_dump($tooltips);
//var_dump($tilesets);

    $version=$xml->attributes()->version;
    $tiledversion = $xml->attributes()->tiledversion;
    $orientation = $xml->attributes()->orientation;
    $renderorder= $xml->attributes()->renderorder;
    $width = $xml->attributes()->width;
$htmlmapwidth =  $width;
    $height = $xml->attributes()->height;
$htmlmapheight = $height;
    $tilewidth = $xml->attributes()->tilewidth;
    $tileheight = $xml->attributes()->tileheight;
    $nextobjectid= $xml->attributes()->nextobjectid;
    $compression = $xml->layer->data->attributes()->compression;
    $encoding = $xml->layer->data->attributes()->encoding;
    $data = $xml->layer->data;
    $data = parse_data($data, $encoding, $compression);
//    var_dump( $data );
//$chars= str_split($data);
//var_dump($chars);
echo "<table cellspacing=0>";

 $htmlline = "<tr>";
for ( $i=0; $i<3200; $i+=4 )
{
 $n =$i/4;
 $rest=($n+1) % 40;
 if ( $n<1 ) $n=1;
 $tableline= ceil($n/$width);
 //echo "<br>".$n."(".$tableline.")(".$rest.") : ";
 $array32 = unpack ( "V", $data, $i ); 
 //var_dump($array32 );
 $tilenumber = $array32[1]; 
 //echo $tilenumber ;

 $tile_id = $tilenumber + $firstgid;
 $imagepath = $tilesets[$tile_id];
 //echo $imagepath;
 //$htmlline .= "<td>".$tile_id."</td>";
 $htmlline .= "<td><img src=".$imagepath."></td>";
 if ( $rest == 0 && $i != 0)
 {
  echo $htmlline."</tr>";
  $htmlline ="";
 }
}
echo "</table>";
/*
/*
$substring = substr($data,0,4);
//echo $substring;
$finalInt = hexdec($substring);
*/

//echo $finalInt;

?>

