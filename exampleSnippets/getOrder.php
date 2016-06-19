function GetOrder($OrderId)
{
    $JWTTOKEN = $this->AuthorizationHandler->getJWT();
    $service_url = $this->BASEURL.$this->APIVERSION.'/orders/'.$OrderId;
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