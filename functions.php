<?php

function load_tilesets_array($xml)
{
 $nextgid=$xml->attributes()->nextobjectid;
 $tilesets = $xml->tileset;
 for ($i = 0; $i < count($tilesets ); $i++)
 {
  //var_dump($tilesets[$i]);
  $firstgid = $tilesets[$i]->attributes()->firstgid;
  $filetileset="map/".$tilesets[$i]->attributes()->source;
  $xmltileset = simplexml_load_file($filetileset);
  $tiles = $xmltileset->tile;
  $htmltileset = "<table><tr>";
  for ($ii = 0; $ii < count($tiles ); $ii++)
  {
   $image = $tiles[$ii]->image;
   $isource = $image->attributes()->source;
   $tile_id =  $tiles[$ii]->attributes()->id ;
   $tile_id = $tile_id + $firstgid;
   $arraytilesets[$tile_id] = $isource;
  }
 }
 return $arraytilesets;
}

function decompress ( $data, $compression)
{
$data2="";

        switch(strtolower($compression)) {
                case 'zlib':
                        $data2=zlib_decode ($data, "2000" );
echo "data = ".$data2."<br>";
                        break;
                case 'gzip':
                        //$data=gzuncompress($data);
                        //$data=gzinflate($data);
                        //$data=softcoded_gzdecode($data);
                        $data2=gzdecode($data);
                        break;
                case 'bzip2':
                case 'bz2':
                        $data2=bzdecompress($data);
                        break;
                case 'none':
                default:
                        break;
        }
 return $data2;

}

function parse_data($data, $encoding='', $compression='') {
        if($encoding=='base64') {
                $data=base64_decode($data);
        }
        else if($encoding=='csv') {
                $data2=explode(chr(10),$data);
                //var_dump(count($data2));
                $data3=array();
                $i=0;
                $data='';
                foreach($data2 as $line) {
                        $line=trim($line, " \t\n\r\0\x0B,");
                        $data3[$i]=explode(',',$line);
                        //var_dump(count($data3[$i]));
                        ++$i;
                }
                unset($line,$data2);
                $irow=0;
                $icol=0;
                $icol2=0;
                foreach($data3 as $row) {
                        $icol=0;
                        foreach($row as $gid) {
                                $data.=pack('V', $gid);
                                ++$icol;
                        }
                        if($icol>$icol2) $icol2=$icol;
                        ++$irow;

                }       
                //var_dump($irow,$icol2);
                unset($gid,$row,$data3);
        }
        else {  
                //$data=$data;
        }
        switch(strtolower($compression)) {
                case 'zlib':
                        $data=gzuncompress($data);
                       break;   
                case 'gzip':
                        //$data=gzuncompress($data);
                        //$data=gzinflate($data);
                        //$data=softcoded_gzdecode($data);
                        $data=gzdecode($data);
                        break;
                case 'bzip2':
                case 'bz2':
                        $data=bzdecompress($data);
                        break;
                case 'none':
                default:
                        break;
        }
        return $data;
}

?>
