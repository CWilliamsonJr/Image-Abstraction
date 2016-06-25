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

      $filename = './searches.txt'; // file name to store past searches
      $search = urlencode(basename($_SERVER['PATH_INFO'])); // gets the serch term from the URL
      $query = $_SERVER['QUERY_STRING']; // gets the offset if there's one

      $response = GetSearch($search); // retrives the results.
      $array = ParseData($response,$query); // parses the results.

      $filecontents = [ // timestamp for what was searched and time of search to be added to a file.
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
