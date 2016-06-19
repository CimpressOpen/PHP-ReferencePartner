function CreateDocumentUpload($SKU, $File, $MultipagePdf)
{   
    $JWTTOKEN = $this->AuthorizationHandler->getJWT();   
    $service_url = $this->BASEURL.$this->APIVERSION.'/documents/creators/file';
    $ch = curl_init($service_url);
    $PostPayload['file'] = new CURLFile($File);
    $PostPayload['Sku'] = $SKU;
    $PostPayload['MultipagePdf'] = $MultipagePdf;
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $PostPayload); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Don't validate the trust chain
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: ' . $JWTTOKEN,
        'Content-Type: multipart/form-data')
    );
    $result = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch); 
    return json_decode($result);
}