<?php
include 'DBconfig.php';  // Db config file
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// routes
$app->get('/cars','getCars'); 
$app->post('/newcar', 'addCar');


$app->run();


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////   Functions  ////////////////////////////////////////////





//////////////////////////// get All cars function //////////////////////////////////////////


function getCars() {
	$sql = "SELECT manufacturer,color FROM car ORDER BY id";
	try {
		$db = getDB();
		$stmt = $db->query($sql);  
		$cars = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"Cars": ' . json_encode($cars) . '}';
	} catch(PDOException $e) {
	    echo "Error !"; 
	}
}






///////////////////////////////// Add car ////////////////////////////////////////////////
function addCar() {
		global $app;
    $req = $app->request(); 
    
    $manufacturer = $req->params('manufacturer'); 
    $color = $req->params('color'); 
    
 
  $sql = "INSERT INTO car (`manufacturer`,`color`) VALUES (:manufacturer, :color);";
  
  
  try {
    $db = getDB();
    $stmt = $db->prepare($sql);
    
      $stmt->bindParam("manufacturer", $manufacturer);
      $stmt->bindParam("color",$color);
 
      $stmt->execute();
      $db = null;
  } catch(PDOException $e) {
      echo "Error !";
  }
}


?>
