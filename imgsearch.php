<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <?php
      require './includes/functions.inc';
     ?>
  </head>
  <body>
    <?php

    if(empty(basename($_SERVER['PATH_INFO']))){ // if nothing is being searched show a webpage
        require './includes/launchpage.inc';
    }else if((basename($_SERVER['PATH_INFO'])) === 'recentsearches'){ // show recent searches page
        require './includes/recentsearch.inc';
    } else{

      $filename = 'searches.txt';
      define('MAX_RESULTS', 50); // Max possible results set to a constant
      $search = urlencode(basename($_SERVER['PATH_INFO'])); // gets the serch term from the URL
      $url = 'https://api.datamarket.azure.com/Bing/Search/v1/Image?$format=json&Query=%27'.$search.'%27'; // sets the url for the search
      $accountKey = '62yWlZ8o2DS8p1uBXEbx/J1rBHoGSLFY3JNVstd1qDE'; // API key for bing search

      $query = $_SERVER['QUERY_STRING']; // gets the offset if there's one

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

      $json = json_decode($response,true); // decodes the response to an array
      parse_str($query); // gets offset from the users

      if(isset($offset)){ // detects if offset was in the query string
        if(!is_numeric($offset) || $offset >= MAX_RESULTS){ // if offset isn't a number set offset to a default
            $offset = count($json['d']['results']);
        }
      }else{
        $offset = count($json['d']['results']); // sets default offset to total amount returned
      }

      for($i = 0; $i < $offset; $i++){ // sorts through the retured request and makes a new array with the wanted values.
        $value = $json['d']['results'][$i];
        $array[] = array(
          'Title' => $value['Title'],
          'Source' => $value['SourceUrl'],
          'ImgUrl' => $value['MediaUrl'],
          'Thumbnail' => $value['Thumbnail']['MediaUrl']
            );
      }
      $filecontents = [ // timestamp for what was seached and time of search to be added to a file.
        'term' => $search,
        'when' => date('M-d-Y g:i a T',$_SERVER['REQUEST_TIME'])
      ];

      if(is_readable($filename)){ // detects if file is readiable.
          AppendPastSearches($filecontents);
        }else{
          $handle = fopen($filename, "a"); // if file doesn't exist create the file;
          fclose($handle);
          AppendPastSearches($filecontents);
        }

      if(!empty($array)){
        echo json_encode($array,JSON_PRETTY_PRINT);
      }
    }

     ?>
  </body>
</html>
