<?php
  function AppendPastSearches($filecontents){
    $filename = './searches.txt';
    if(is_readable($filename)){
        $pastsearches = json_decode(file_get_contents($filename),true);
        $allsearches = array_merge_recursive($filecontents,$pastsearches);        
        file_put_contents($filename,json_encode($allsearches,true));
      }
  }
 ?>
