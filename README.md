# php-mysql-tiled-map-tiles

Basic tools for accessing storing [Tiled](https://www.mapeditor.org/) with MySQL using PHP, tilesets and 32x32 tiles (for now). Layers and terrain are not support yet. Feedback and code is welcome!

## Setting up the project

Set `$mapname` to the path of your Tiled-map (.tmx):

    $mapfolder= "map";

Set `$mapname` to the name of your Tiles-map file:

    $mapname = "agame_v1.tmx";

Set `$tilefolder` to point to the path of your tiles images (should work with non pico tiles):

    $tilefolder="piko";

Set the database configuration (this is only needed if you want to test the mysql import feature):

    $mysqlhost="localhost";
    $mysqldb="agame";
    $mysqluser="agame";
    $mysqlpass="YOURPASS";

By default the map image files are stored in `../piko`, so you have to move the piko folder up one level for it to wokr:

    mv piko ..

## About

The example are all made by me, using [PikoPixel](http://twilightedge.com/mac/pikopixel/) for the tilesets and [Tiled](https://www.mapeditor.org/) for the maps.

This project is written in PHP and support importing, diplaying, and storing maps in a MySQL database.

The implementation is pretty basic, this so see this more like a coding examples of how to access and display tiled maps in PHP.

## Features
### Read and display map tilesets

    ./read_map_tilesets.php

### Show the full tiled map

    ./show_map.php

### Work in progress

Reading, and importing everything into MySQL.
