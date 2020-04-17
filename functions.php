<?php

function load_tooltips_array($xml, $link = null)
{
    $nextgid = $xml->attributes()->nextobjectid;

    foreach ($xml->tileset as $tileset) {
        $firstgid = $tileset->attributes()->firstgid;
        $filetileset = "map/".$tileset->attributes()->source;
        $xmltileset = simplexml_load_file($filetileset);
        $htmltileset = "<table><tr>";

        foreach ($xmltileset->tile as $tile) {
            $image = $tile->image;
            $isource = $image->attributes()->source;
            $tile_id = $tile->attributes()->id;
            $tile_id = $tile_id + $firstgid;

            if ($tile->properties) {
                $tile_tooltip = $tile->properties->property->attributes()->value;
            }

            $arraytooltips[$tile_id] = $tile_tooltip;

            if ($link) {
                $sql = " INSERT INTO tile ( t_tiletype, t_tilepath ) VALUES(".$tile_id.",'".$isource."' )";
                if (!mysqli_query($link, $sql)) {
                    echo "Error: ".$sql."<br>".mysqli_error($conn);
                    continue;
                }
                echo " . ";
            }
        }
        if ($link) {
            $sql = "INSERT INTO tileset( ts_source,ts_firstgid ) VALUES('".$filetileset."',".$firstgid.") ";
            if (!mysqli_query($link, $sql)) {
                echo "Error: ".$sql."<br>".mysqli_error($conn);
                continue;
            }
            echo " . ";
        }
    }

    return $arraytooltips;
}

function load_tilesets_array($xml, $link = null)
{
    $nextgid = $xml->attributes()->nextobjectid;

    foreach ($xml->tileset as $tileset) {
        $firstgid = $tileset->attributes()->firstgid;
        $filetileset = "map/".$tileset->attributes()->source;
        $xmltileset = simplexml_load_file($filetileset);
        $htmltileset = "<table><tr>";

        foreach ($xmltileset->tile as $tile) {
            $image = $tile->image;
            $isource = $image->attributes()->source;
            $tile_id = $tile->attributes()->id;
            $tile_id = $tile_id + $firstgid;
            $arraytilesets[$tile_id] = $isource;

            if ($link) {
                $sql = " INSERT INTO tile ( t_tiletype, t_tilepath ) VALUES(".$tile_id.",'".$isource."' )";
                if (!mysqli_query($link, $sql)) {
                    echo "Error: ".$sql."<br>".mysqli_error($conn);
                    continue;
                }
                echo " . ";
            }
        }
        if ($link) {
            $sql = "INSERT INTO tileset( ts_source,ts_firstgid ) VALUES('".$filetileset."',".$firstgid.") ";
            if (!mysqli_query($link, $sql)) {
                echo "Error: ".$sql."<br>".mysqli_error($conn);
                continue;
            }
            echo " . ";
        }
    }

    return $arraytilesets;
}

function parse_data($data, $encoding = '', $compression = '')
{
    if ($encoding == 'base64') {
        $data = base64_decode($data);
    } elseif ($encoding == 'csv') {
        $data2 = explode(chr(10), $data);
        $data3 = [];
        $i = 0;
        $data = '';
        foreach ($data2 as $line) {
            $line = trim($line, " \t\n\r\0\x0B,");
            $data3[$i] = explode(',', $line);
            ++$i;
        }
        unset($line,$data2);
        $irow = 0;
        $icol = 0;
        $icol2 = 0;
        foreach ($data3 as $row) {
            $icol = 0;
            foreach ($row as $gid) {
                $data .= pack('V', $gid);
                ++$icol;
            }
            if ($icol > $icol2) {
                $icol2 = $icol;
            }
            ++$irow;
        }
        unset($gid,$row,$data3);
    }

    switch (strtolower($compression)) {
        case 'zlib':
            $data = gzuncompress($data);
           break;
        case 'gzip':
            $data = gzdecode($data);
            break;
        case 'bzip2':
        case 'bz2':
            $data = bzdecompress($data);
            break;
        case 'none':
        default:
            break;
    }

    return $data;
}
