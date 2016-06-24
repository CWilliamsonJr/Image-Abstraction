<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>

  </head>
  <body>
    <?php
//TODO: Add a way to store previous search results.

    if(empty(basename($_SERVER['PATH_INFO']))){ // if nothing is being searched show a webpage
      $site =  $_SERVER['SERVER_NAME']; //website path
      $html = <<<HTML
<div class='container'>
  <div class='row'>
    <div class='h1'>Image Search Abstraction Layer <span class='h4'>Completed with PHP</span> </div>
    <blockquote>
    User Stories:
    <ol>
    <li>I can get the image URLs, alt text and page urls for a set of images relating to a given search string. </li>
    <li>I can paginate through the responses by adding a ?offset=2 parameter to the URL. </li>
    <li>I can get a list of the most recently submitted search strings. </li>
    </ol>
    </blockquote>
    </div>
    <div class='h3'>Example Usage: </div>
    <div><code>$site/ImageSearch/imgsearch.php/[img you want to search]?offset=[number of returned results]</code></div>
    <div><code>$site/ImageSearch/imgsearch.php/cars?offset=10</code></div> <br/>
    <div> </div>
    <div class='h3'>Example Output: </div>
    <code>
          { <br/>
      Title: "Cars News and Images: Cars pictures", <br/>
      Source: "http://cars-news-images.blogspot.com/p/cars-pictures_26.html", <br/>
      ImgUrl: "http://2.bp.blogspot.com/-DXumDyjcLf4/USyuoPUXYRI/AAAAAAAAASw/-TNzVUSDAcE/s1600/American-cars-Camaro-convertible_car.jpg", <br/>
      Thumbnail: "http://ts4.mm.bing.net/th?id=OIP.M58c43935d427addd462e40723594360cH0&pid=15.1" <br/>
      }, <br/>
      { <br/>
      Title: "home vehicles cars cars photo tags photo muscle car", <br/>
      Source: "http://myphotos.eu/photography-69_cars_photo_muscle_car.html", <br/>
      ImgUrl: "http://www.myphotos.eu/photos/vehicles/cars/69_cars_photo_muscle_car.jpg", <br/>
      Thumbnail: "http://ts2.mm.bing.net/th?id=OIP.Mc082e2d4a54529995c2aa0dd50eb98ecH0&pid=15.1" <br/>
      },
    </code>
  </div>
</div>
HTML;
      echo $html;
    }else{
      define('MAX_RESULTS', 50); // Max possible results set to a constant
      $search = urlencode(basename($_SERVER['PATH_INFO'])); // gets the serch term from the URL
      $url = 'https://api.datamarket.azure.com/Bing/Search/v1/Image?$format=json&Query=%27'.$search.'%27'; // sets the url for the search
      $accountKey = '62yWlZ8o2DS8p1uBXEbx/J1rBHoGSLFY3JNVstd1qDE'; // API key for bing search

      $query = $_SERVER['QUERY_STRING']; // gets the offset if there's one

      //echo "$search <br/>";

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

      for($i = 0; $i < $offset; $i++){
        $value = $json['d']['results'][$i];
        $array[] = array(
          'Title' => $value['Title'],
          'Source' => $value['SourceUrl'],
          'ImgUrl' => $value['MediaUrl'],
          'Thumbnail' => $value['Thumbnail']['MediaUrl']
            );
      }
      if(!empty($array)){
        echo json_encode($array,JSON_PRETTY_PRINT);
      }
    }

     ?>
  </body>
</html>
