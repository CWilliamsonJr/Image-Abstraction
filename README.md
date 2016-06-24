
## Image Search Abstraction Layer Completed with PHP
### User Stories:  
>1.I can get the image URLs, alt text and page urls for a set of images relating to a given search string.  
>2.I can paginate through the responses by adding a ?offset=2 parameter to the URL.  
>3.I can get a list of the most recently submitted search strings.  

Example Usage:  
`[yoursite]/ImageSearch/imgsearch.php/[img you want to search]?offset=[number of returned results]`  
`[yoursite]/ImageSearch/imgsearch.php/cars?offset=10`

**NOTE:Max results possible is 50.**

Example Output:
```json
{  
  Title: "Ferrari Enzo Wallpaper HD | Cars WallPaper HD",
  Source: "http://carswallpaperhd.com/ferrari-enzo-wallpaper-hd.html",
  ImgUrl: "http://carswallpaperhd.com/wp-content/uploads/2012/06/ferrari-enzo.jpg",
  Thumbnail: "http://ts1.mm.bing.net/th?id=OIP.M1168b2fdb13210999cc1eb1f3b36690aH0&pid=15.1"  
},  
{  
  Title: "home vehicles cars cars photo tags photo muscle car",  
  Source: "http://myphotos.eu/photography-69_cars_photo_muscle_car.html",  
  ImgUrl: "http://www.myphotos.eu/photos/vehicles/cars/69_cars_photo_muscle_car.jpg",  
  Thumbnail: "http://ts2.mm.bing.net/th?id=OIP.Mc082e2d4a54529995c2aa0dd50eb98ecH0&pid=15.1"  
},
```
For recent searches:  
`[yoursite]/ImageSearch/imgsearch.php/recentsearches`
