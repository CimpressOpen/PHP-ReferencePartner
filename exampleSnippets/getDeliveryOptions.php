function getDeliveryOptions($SKU, $Quantity, // Product Selection
            $AddressLine1, $AddressLine2, $City, $StateRegion, $PostalCode, $CountryCode) // Shipping info
{
    $JWTTOKEN = $this->AuthorizationHandler->getJWT();
    $service_url = $this->BASEURL.$this->APIVERSION.'/delivery-options';
    $ch = curl_init($service_url);

    $DeliveryOptionsReq =
            '{
      "DestinationAddress": {
        "AddressLine1": "'.$AddressLine1.'",
        "AddressLine2": "'.$AddressLine2.'",
        "City": "'.$City.'",
        "CountryCode": "'.$CountryCode.'",
        "StateOrRegion": "'.$StateRegion.'",
        "PostalCode": "'.$PostalCode.'"
      },
      "Items": [
        {
          "Quantity": '.$Quantity.',
          "Sku": "'.$SKU.'"
        }
      ]
    }';
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $DeliveryOptionsReq); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Don't validate the trust chain
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: ' . $JWTTOKEN,
        'Content-Type: application/json')
    );
    $result = curl_exec($ch);  
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return json_decode($result, true);
}