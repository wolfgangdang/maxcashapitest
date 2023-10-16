<?php
// Set headers to allow cross-origin resource sharing (CORS)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

// Retrieve the search query
$query = $_GET['q'];

// Load the JSON file
$json = file_get_contents('https://raw.githubusercontent.com/wolfgangdang/maxcashapitest/main/perdiemjson.json');
$data = json_decode($json, true);

// Filter the data based on the search query
$results = array_filter($data, function($item) use ($query) {
  return strpos(strtolower($item['STATE']), strtolower($query)) !== false
    || strpos(strtolower($item['DESTINATION']), strtolower($query)) !== false
    || strpos(strtolower($item['COUNTY_LOCATION_DEFINED']), strtolower($query)) !== false;
});

// Generate the JSON response
header('Content-Type: application/json');
echo json_encode($results);
?>