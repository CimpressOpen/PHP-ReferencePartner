function PlaceFreeOrder($SKU, $Quantity, // Product Selection
    $AddressLine1, $AddressLine2, $City, $StateRegion, $PostalCode, $CountryCode, $DeliveryOptionId, // Shipping info
    $FirstName, $LastName, $MiddleName, $CompanyName, $PhoneNum, $Ext, // Customer Info
    $PartnerOrderId, $PartnerItemId, $PartnerProductName, // Parnter Info
    $DocumentId, $DocumentInstructionSourceUrl, $DocumentInstructionSourceVersion) // Cimpress Document info
{
    $JWTTOKEN = $this->AuthorizationHandler->getJWT();   
    $service_url = $this->BASEURL.$this->APIVERSION.'/remediation/freeorders';
    $ch = curl_init($service_url);
    $Body = $this->buildOrderObject($SKU, $Quantity,
             $AddressLine1, $AddressLine2, $City, $StateRegion, $PostalCode, $CountryCode, $DeliveryOptionId,
             $FirstName, $LastName, $MiddleName, $CompanyName, $PhoneNum, $Ext,
             $PartnerOrderId, $PartnerItemId, $PartnerProductName,
             $DocumentId, $DocumentInstructionSourceUrl, $DocumentInstructionSourceVersion);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $Body); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Don't validate the trust chain
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: ' . $JWTTOKEN,
        'Content-Type: application/json')
    );

    $result = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    return json_decode($result);
}