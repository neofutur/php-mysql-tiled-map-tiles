# php-mysql-tiled-map-tiles
accessing with php and storing with mysql of tiled maps, tilesets and tiles

edit the config file :

$mapfolder= "map";

where you will put your tiled map ( .tmx ) and other files 

$mapname = "agame_v1.tmx";

the tiles map file

$tilefolder="piko";
where are your tiles images ( should work with non pico tiles )

and the db config, only needed if you want to test the mysql import feature :

$mysqlhost="localhost";
$mysqldb="agame";
$mysqluser="agame";
$mysqlpass="YOURPASS";

example tilesets all made by me with PikoPixel
http://twilightedge.com/mac/pikopixel/

map made by me with tiled
https://www.mapeditor.org/

importing this with php , diplaying it, and storing it in a mysql database.

only basic support, this is more like coding examples to access and display tiled maps, in php.

for now only two features : 
read and display map tilesets : 
/read_map_tilesets.php
and show the full tiled map : 
/show_map.php

coming soon, reading and importing everything into mysql.
