function GetRemediationReceipts($OrderIds)
{
    $JWTTOKEN = $this->AuthorizationHandler->getJWT();
    $service_url = $this->BASEURL.$this->APIVERSION.'/remediation/receipts';
    if(!empty($OrderIds)){
        $OrderIdList = $thePostIdArray = explode(', ', $OrderIds);
        $service_url = $service_url . '?OrderIds=';
        foreach ($OrderIdList as $OrderId) {
           $service_url = $service_url . $OrderId .',';
        }
    }
    $ch = curl_init($service_url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Don't validate the trust chain
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: ' . $JWTTOKEN,
        'Content-Type: application/json')
    );
    $result = curl_exec($ch);  
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return json_decode($result);
}