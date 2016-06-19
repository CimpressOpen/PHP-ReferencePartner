function ModifyDocument($DocumentId, $SurfaceName, $Rotation)
{        
$JWTTOKEN = $this->AuthorizationHandler->getJWT();   
$service_url = $this->BASEURL.$this->APIVERSION.'/documents/'.$DocumentId.'/edit';
$ch = curl_init($service_url);
$JsonModDocument = '{
  "ImageOperations": [
    {
      "SurfaceId": "'.$SurfaceName.'",
      "Rotation": '.$Rotation.'
    }
  ]
}';
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $JsonModDocument); 
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