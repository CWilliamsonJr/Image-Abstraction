<?php
  define('MAX_STORED',20); // Max number of past searches stored.
  define('MAX_RESULTS', 50); // Max possible results possible
  
  function AppendPastSearches($filecontents){
    $filename = './searches.txt';
    if(is_readable($filename)){
        if(is_readable($filename)){
            $pastsearches = json_decode(file_get_contents($filename),true); // reads JSON from the file and turns it into an array
        }
        if(isset($pastsearches)){
          $allsearches = array_merge_recursive($filecontents,$pastsearches); //merges current search with past searches
          if(count($allsearches['term']) >= MAX_STORED){ // sets the file to no more than the last 20 searches stored
            $allsearches['term'] = array_slice($allsearches['term'],0,MAX_STORED,true);
            $allsearches['when'] = array_slice($allsearches['when'],0,MAX_STORED,true);
          }
        }else{
          $allsearches = $filecontents;
        }
        file_put_contents($filename,json_encode($allsearches,true)); // writes to the file
      }
  }

  function is_set($query, $max_limit){
    parse_str($query); // gets offset from the users
    if(isset($offset)){ // detects if offset was in the query string
      if(!is_numeric($offset) || $offset >= MAX_RESULTS){ // if offset isn't a number set offset to a default
          $offset = $max_limit;
      }
    }else{
      $offset = $max_limit; // sets default offset to total amount returned
    }
    return $offset;
  }

  function ParseData($response,$offset){

    $json = json_decode($response,true); // decodes the response to an array
    $offset = is_set($offset,count($json['d']['results']));

    for($i = 0; $i < $offset; $i++){ // sorts through the retured request and makes a new array with the wanted values.
      $value = $json['d']['results'][$i];
      $array[] = array(
        'Title' => $value['Title'],
        'Source' => $value['SourceUrl'],
        'ImgUrl' => $value['MediaUrl'],
        'Thumbnail' => $value['Thumbnail']['MediaUrl']
          );
    }
    return $array;
  }
  function GetSearch($search){
    $url = 'https://api.datamarket.azure.com/Bing/Search/v1/Image?$format=json&Query=%27'.$search.'%27'; // sets the url for the search
    $accountKey = '62yWlZ8o2DS8p1uBXEbx/J1rBHoGSLFY3JNVstd1qDE'; // API key for bing search
    // Initiate curl
    $ch = curl_init();
    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Sets authentication to Basic
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // Sets the url
    curl_setopt($ch, CURLOPT_URL, $url);
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // sets username and password
    curl_setopt($ch, CURLOPT_USERPWD, $accountKey. ':'.$accountKey);
    // Sets headers
    curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
    //Execute
    $response = curl_exec($ch);
    // closes curl
    curl_close($ch);

    return $response;
  }

 ?>
