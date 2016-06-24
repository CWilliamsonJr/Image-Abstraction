
## Image Search Abstraction Layer Completed with PHP
### User Stories:  
>1.I can get the image URLs, alt text and page urls for a set of images relating to a given search string.  
>2.I can paginate through the responses by adding a ?offset=2 parameter to the URL.  
>3.I can get a list of the most recently submitted search strings.  

Example Usage:  
`www.cewjr.us/ImageSearch/imgsearch.php/[img you want to search]?offset=[number of returned results]`  
`www.cewjr.us/ImageSearch/imgsearch.php/cars?offset=10`

**NOTE:Max results possible is 50.**

Example Output:
```json
{  
Title: "Cars News and Images: Cars pictures",  
Source: "http://cars-news-images.blogspot.com/p/cars-pictures_26.html",  
ImgUrl:"http://2.bp.blogspot.com/-DXumDyjcLf4/USyuoPUXYRI/AAAAAAAAASw/-TNzVUSDAcE/s1600/American-cars-Camaro-convertible_car.jpg",  
Thumbnail: "http://ts4.mm.bing.net/th?id=OIP.M58c43935d427addd462e40723594360cH0&pid=15.1"  
},  
{  
Title: "home vehicles cars cars photo tags photo muscle car",  
Source: "http://myphotos.eu/photography-69_cars_photo_muscle_car.html",  
ImgUrl: "http://www.myphotos.eu/photos/vehicles/cars/69_cars_photo_muscle_car.jpg",  
Thumbnail: "http://ts2.mm.bing.net/th?id=OIP.Mc082e2d4a54529995c2aa0dd50eb98ecH0&pid=15.1"  
},
```
