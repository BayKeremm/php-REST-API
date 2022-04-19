<?php
class MeasurementController extends BaseController
{
	public function putAction($type,$value,$plantId){
		    $strErrorDesc = '';
	        $requestMethod = $_SERVER["REQUEST_METHOD"];

		if(strtoupper($requestMethod) == 'POST'){
			try{
				$MeasurementModel = new MeasurementModel();
				$insertData = $MeasurementModel->putValue($type,$value,$plantId);
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

    public function listMeasurementsAction($limit){
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
 
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new MeasurementModel();
 
                $arrMeasurements = $userModel->getMeasurements($limit);
                $responseData = json_encode($arrMeasurements);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
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
    public function dayAction(){
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
 
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $MeasurementModel = new MeasurementModel();
                $arrDayParameters = $MeasurementModel->getDayParameters();
                $json_result = json_decode($arrDayParameters);
                $sunrise = (int) filter_var($json_result->{'results'}->{'civil_twilight_end'},FILTER_SANITIZE_NUMBER_INT);
                $sunset = (int) filter_var($json_result->{'results'}->{'nautical_twilight_end'},FILTER_SANITIZE_NUMBER_INT)+120000;
                $current = date('His'); 
                if($sunrise - $current < 0) $day = 1;
                if($sunset - $current< 0)  $day = 0;
                if($day){
                    $wait_time = $sunset-$current;
                }else{
                    $wait_time = $sunrise-$current;
                }
                $to_wait = round($wait_time/10000);
                $arr = array('day'=>$day,'wait'=>$to_wait);
                $responseData = json_encode($arr);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
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
