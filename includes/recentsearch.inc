<?php
  $filename = './searches.txt';
try{
    if(is_readable($filename)){
        $pastsearches = json_decode(file_get_contents($filename),true);
      }else{

      }
    if(empty($pastsearches)) throw new Exception('No past searches') ;
  $count = count($pastsearches['term']);
  for($i = 0; $i < $count; $i++){
    $prevSearches[] = array(
      'term' => $pastsearches['term'][$i],
      'when' => $pastsearches['when'][$i]
    );
  }
  if(!empty($prevSearches)){
    echo json_encode($prevSearches,JSON_PRETTY_PRINT);
  }
}catch(Exception $e){
  echo $e->getMessage();
}

 ?>
