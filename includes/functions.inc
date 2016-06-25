<?php
  define('MAX_STORED',20);
  function AppendPastSearches($filecontents){
    $filename = './searches.txt';
    if(is_readable($filename)){
        $pastsearches = json_decode(file_get_contents($filename),true); // reads JSON from the file and turns it into an array
        $allsearches = array_merge_recursive($filecontents,$pastsearches); //merges current search with past searches
        if(count($allsearches['term']) >= MAX_STORED){ // sets the file to no more than the last 20 searches stored
          $allsearches['term'] = array_slice($allsearches['term'],0,MAX_STORED,true);
          $allsearches['when'] = array_slice($allsearches['when'],0,MAX_STORED,true);
        }
        file_put_contents($filename,json_encode($allsearches,true)); // writes to the file
      }
  }
 ?>
