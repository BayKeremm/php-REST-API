<?php
require __DIR__ . "/inc/bootstrap.php";
 
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
 
if ((isset($uri[2]) && $uri[2] != 'user')) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
 
 
if($uri[3] == 'list'){
    require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
	$objFeedController = new UserController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}();
}
if($uri[3] == 'put'){
    require PROJECT_ROOT_PATH . "/Controller/Api/MeasurementController.php";
	$objFeedController = new MeasurementController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}($uri[4],$uri[5],$uri[6]);
}

?>
