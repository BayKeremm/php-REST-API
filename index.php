<?php
require __DIR__ . "/inc/bootstrap.php";
require_once 'jwt_utils.php';
// API 
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$set = 0;
if (isset($_GET["token"])) {
    $jwt_token = $_GET["token"]; 
    $set = 1;
} else {
    $set = 0;
}
 
if ((isset($uri[2]) && $uri[2] != 'api')|| !isset($uri[3])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

// TODO:
// Add another field where user puts the mac address of the iot device
if($uri[3] == 'register'){
    require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
	$objFeedController = new UserController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}($uri[4],$uri[5]);
}

if($uri[3] == 'login'){
    require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
	$objFeedController = new UserController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}($uri[4],$uri[5]);
}


if($set == 1){
    $is_jwt_valid = is_jwt_valid($jwt_token);
    if(!$is_jwt_valid){
        echo json_encode(array('error' => 'Access denied'));
        exit();
    }
}else{
        echo json_encode(array('error' => 'Access denied'));
        exit();

}


if($uri[3] == 'day'){
    require PROJECT_ROOT_PATH . "/Controller/Api/MeasurementController.php";
	$objFeedController = new MeasurementController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}();
}

if($uri[3] == 'updateOwnedPlant'){
    require PROJECT_ROOT_PATH . "/Controller/Api/PlantController.php";
	$objFeedController = new PlantController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}($uri[4],$uri[5],$uri[6],$uri[7]);
}

if($uri[3] == 'insertOwnedPlant'){
    require PROJECT_ROOT_PATH . "/Controller/Api/PlantController.php";
	$objFeedController = new PlantController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}($uri[4],$uri[5],$uri[6],$uri[7]);
}

if($uri[3] == 'listOwnedPlants'){
    require PROJECT_ROOT_PATH . "/Controller/Api/PlantController.php";
	$objFeedController = new PlantController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}($uri[4]);
}

if($uri[3] == 'listPlants'){
    require PROJECT_ROOT_PATH . "/Controller/Api/PlantController.php";
	$objFeedController = new PlantController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}();
}

if($uri[3] == 'listMeasurements' ){
    if(!isset($uri[4])){
        header("HTTP/1.1 404 Not Found");
        exit();
    }
    require PROJECT_ROOT_PATH . "/Controller/Api/MeasurementController.php";
	$objFeedController = new MeasurementController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}($uri[4]);
} 

if($uri[3] == 'listUsers'){
    require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
	$objFeedController = new UserController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}();
}
if($uri[3] == 'put'){ // TO PUT MEASUREMENT
    require PROJECT_ROOT_PATH . "/Controller/Api/MeasurementController.php";
	$objFeedController = new MeasurementController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}($uri[4],$uri[5],$uri[6]);
}

?>
