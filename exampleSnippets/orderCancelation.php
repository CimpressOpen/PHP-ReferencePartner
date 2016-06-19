function CancelOrder($OrderId)
{
    $JWTTOKEN = $this->AuthorizationHandler->getJWT();
    $service_url = $this->BASEURL.$this->APIVERSION.'/remediation/cancellations';
    $ch = curl_init($service_url);
    $CancellationBody = '{
      "OrderId": "'.$OrderId.'"
    }';
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $CancellationBody); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Don't validate the trust chain
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: ' . $JWTTOKEN,
        'Content-Type: application/json')
    );
    $result = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    //Return the code because expected body will be null
    return $httpcode;
}