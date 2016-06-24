<?php
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
  <div class='h3'>For Recent Searches: </div>
  <div><code>$site/ImageSearch/imgsearch.php/recentsearches</code></div> <br/>
  </div>

</div>
HTML;
echo $html;
 ?>
