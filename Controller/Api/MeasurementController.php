<?php
class MeasurementController extends BaseController
{
	public function putAction($type,$timestamp,$value){
		    $strErrorDesc = '';
	        $requestMethod = $_SERVER["REQUEST_METHOD"];

		if(strtoupper($requestMethod) == 'POST'){
			try{
				$MeasurementModel = new MeasurementModel();
				$insertData = $MeasurementModel->putValue($type,$timestamp,$value);
				$responseData = json_encode($insertData);
			}catch(Error $e){
				$strErrorDesc = $e->getMessage().'Something went wrong! Please contact support inside Measueremnt.';
       		                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
			}
		}else{
			$strErrorDesc = 'Method not supported';
	                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';	
		}
		// send output
	        if (!$strErrorDesc) {
        	    	$this->sendOutput(
                	$responseData,
               		array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            		);
        	} else {
            		$this->sendOutput(json_encode(array('error' => $strErrorDesc)),
                	array('Content-Type: application/json', $strErrorHeader)
            		);
        	}
	}
}
