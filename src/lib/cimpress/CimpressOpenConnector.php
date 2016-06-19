<?php

include ('lib/Authorization/authorization.php');

class CimpressOpenConnector
{

    // Class Scoped Variables
    private $BASEURL = 'https://api.cimpress.io/sandbox/vcs/printapi/';
    private $APIVERSION = 'v1';
    private $AuthorizationHandler;

    function __construct() {
       $this->AuthorizationHandler = new authorization();
    }

    private function initalize()
    {
        $this->AuthorizationHandler = new authorization();
    }

    function getProducts()
    {
        $JWTTOKEN = $this->AuthorizationHandler->getJWT();   
        $service_url = $this->BASEURL.$this->APIVERSION.'/partner/products';
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

    function getProductPricing()
    {
        $JWTTOKEN = $this->AuthorizationHandler->getJWT();   
        $service_url = $this->BASEURL.$this->APIVERSION.'/partner/product-prices';

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

    function getProductSides($SKU)
    {
        $JWTTOKEN = $this->AuthorizationHandler->getJWT();   
        $service_url = $this->BASEURL.$this->APIVERSION.'/products/'.$SKU.'/surfaces';

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

    // Document section 

    function GetDocumentPreview($SKU, $DocumentInstructionSourceUrl, $Width)
    {        
        $JWTTOKEN = $this->AuthorizationHandler->getJWT();   
        $service_url = $this->BASEURL.$this->APIVERSION.'/documents/previews?Sku='.$SKU.'&InstructionSourceUrl='.$DocumentInstructionSourceUrl.'&Width='.$Width;         

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

    function CreateDocumentURL($SKU, $ImageURL)
    {        
        $JWTTOKEN = $this->AuthorizationHandler->getJWT();   
        $service_url = $this->BASEURL.$this->APIVERSION.'/documents/creators/url';

         $JsonDocument = '{
          "Sku": "'. $SKU .'",
          "Images": [
            {
              "ImageUrl": "'. $ImageURL .'",
              "MultipagePdf": false
            }
          ]
        }';

        $ch = curl_init($service_url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $JsonDocument); 
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

    // Delivery Options section

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

    // Order Section

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

    private function buildOrderObject($SKU, $Quantity, // Product Selection
                $AddressLine1, $AddressLine2, $City, $StateRegion, $PostalCode, $CountryCode, $DeliveryOptionId, // Shipping info
                $FirstName, $LastName, $MiddleName, $CompanyName, $PhoneNum, $Ext, // Customer Info
                $PartnerOrderId, $PartnerItemId, $PartnerProductName, // Parnter Info
                $DocumentId, $DocumentInstructionSourceUrl, $DocumentInstructionSourceVersion) // Cimpress Document info
    {

        $OrderJSON = '{
          "PartnerOrderId": "'.$PartnerOrderId.'",
          "Items": [
            {
              "Quantity": '.$Quantity.',
              "Sku": "'.$SKU.'",
              "DocumentId": "'.$DocumentId.'",
              "DocumentInstructionSourceUrl": "'.$DocumentInstructionSourceUrl.'",
              "DocumentInstructionSourceVersion": "'.$DocumentInstructionSourceVersion.'",
              "PartnerItemId": "'.$PartnerItemId.'",
              "PartnerProductName": "'.$PartnerProductName.'"
            }
          ],
          "DestinationAddress": {
            "FirstName": "'.$FirstName.'",
            "LastName": "'.$LastName.'",
            "MiddleName": "'.$MiddleName.'",
            "CompanyName": "'.$CompanyName.'",
            "Phone": "'.$PhoneNum.'",
            "PhoneExtension": "'.$Ext.'",
            "AddressLine1": "'.$AddressLine1.'",
            "AddressLine2": "'.$AddressLine2.'",
            "City": "'.$City.'",
            "StateOrRegion": "'.$StateRegion.'",
            "PostalCode": "'.$PostalCode.'",
            "CountryCode": "'.$CountryCode.'"
          },
          "DeliveryOptionId": "'.$DeliveryOptionId.'"
        }';
        return $OrderJSON;
    }


    function PlaceOrder($SKU, $Quantity, // Product Selection
                $AddressLine1, $AddressLine2, $City, $StateRegion, $PostalCode, $CountryCode, $DeliveryOptionId, // Shipping info
                $FirstName, $LastName, $MiddleName, $CompanyName, $PhoneNum, $Ext, // Customer Info
                $PartnerOrderId, $PartnerItemId, $PartnerProductName, // Parnter Info
                $DocumentId, $DocumentInstructionSourceUrl, $DocumentInstructionSourceVersion) // Cimpress Document info
    {
        $JWTTOKEN = $this->AuthorizationHandler->getJWT();   
        $service_url = $this->BASEURL.$this->APIVERSION.'/orders';

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


    //Remediation Section
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

        echo $result;
        //Return the code because expected body will be null
        return $httpcode;
    }

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
}
?>