<?php 
	// Includes
	include('includes/header.html');
	include ('lib/cimpress/CimpressOpenConnector.php');
	$CimpressOpen = new CimpressOpenConnector(); 
	?>
<div class="container">
	<nav class="navbar navbar-inverse">
		<div class="navbar-header">
			<ul class="nav navbar-nav">
				<a class="navbar-brand" href="../index.html">Cimpress Open</a>
				<li><a href="Selection.php">Endpoint Selection</a></li>
				<li><a href="Products.php">Products</a></li>
				<li><a href="Documents.php">Documents</a></li>
				<li><a href="DeliveryOptions.php">Delivery Options</a></li>
				<li><a href="Orders.php">Orders</a></li>
				<li class="active"><a href="Remediation.php">Remediation</a></li>
				<span class="sr-only">Toggle navigation</span>
			</ul>
		</div>
	</nav>
	<div class="row">
		<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Actions</h3>
				</div>
				<div class="panel-body">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#collapse1">Get Remediation Receipts</a>
							</h4>
						</div>
						<div id="collapse1" class="panel-collapse collapse">
							<div class="panel-body">
								<form method="POST" action="">
									<div class="form-group">
										<label for="RemediationOrderIds">Order IDs:</label>
										<input type="text" class="form-control" id="RemediationOrderIds" name="RemediationOrderIds">
										<span id="helpBlock" class="help-block">Optional Comma seperated list of OrderIds</span>
									</div>
									<p>
										<button type="submit" class="btn btn-sm btn-info dropdown" name="RemediationReceipts">GO!</button>
									</p>
								</form>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#collapse2">Order Cancellation</a>
							</h4>
						</div>
						<div id="collapse2" class="panel-collapse collapse">
							<div class="panel-body">
								<form method="POST" action="">
									<div class="form-group">
										<label for="CancelOrderID">Order IDs:</label>
										<input type="text" class="form-control" id="CancelOrderID" name="CancelOrderID">
										<span id="helpBlock" class="help-block">Order ID of order to cancel</span>
									</div>
									<p>
										<button type="submit" class="btn btn-sm btn-info dropdown" name="OrderCancelation">GO!</button>
									</p>
								</form>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#collapse3">Create Free Order</a>
							</h4>
						</div>
						<div id="collapse3" class="panel-collapse collapse">
							<div class="panel-body">
								<form method="POST" action="">
									<div class="well">
										<h4>Product</h4>
										<div class="form-group">
											<br>
											<label for="SKU">SKU:</label>
											<input type="text" class="form-control" id="SKU" name="SKU">
											<span id="helpBlock" class="help-block">SKU of the Product to order</span>
											<label for="Quantity">Quantity:</label>
											<input type="number" min="0" class="form-control" id="Quantity" name="Quantity">
											<span id="helpBlock" class="help-block">Quantity of the product to order</span>
										</div>
									</div>
									<div class="well">
										<h4>Input Your Address</h4>
										<div class="form-group">
											<label for="AddressLine1">Address Line 1:</label>
											<input type="string" class="form-control" id="AddressLine1" name="AddressLine1">
											<span id="helpBlock" class="help-block">The Address Line 1</span>
											<label for="AddressLine2">Address Line 2:</label>
											<input type="string" class="form-control" id="AddressLine2" name="AddressLine2">
											<span id="helpBlock" class="help-block">The Address Line 2</span>
											<label for="City">City:</label>
											<input type="string" class="form-control" id="City" name="City">
											<span id="helpBlock" class="help-block">The City</span>
											<label for="StateRegion">State or Region:</label>
											<input type="string" class="form-control" id="StateRegion" name="StateRegion">
											<span id="helpBlock" class="help-block">The State or Region</span>
											<label for="PostalCode">Postal Code:</label>
											<input type="string" class="form-control" id="PostalCode" name="PostalCode">
											<span id="helpBlock" class="help-block">The Postal Code</span>
											<label for="CountryCode">Country Code:</label>
											<input type="string" class="form-control" id="CountryCode" name="CountryCode">
											<span id="helpBlock" class="help-block">The ISO 3166-1 alpha-2 Country Code</span>
											<label for="DeliveryOptionId">Delivery Option ID:</label>
											<input type="number" min="0" class="form-control" id="DeliveryOptionId" name="DeliveryOptionId">
											<span id="helpBlock" class="help-block">This is the numeric value from the delivery options request</span>
										</div>
									</div>
									<div class="well">
										<h4>Customer Information</h4>
										<div class="form-group">
											<label for="FirstName">First Name:</label>
											<input type="string" class="form-control" id="FirstName" name="FirstName">
											<span id="helpBlock" class="help-block">First name of the customer</span>
											<label for="LastName">Last Name:</label>
											<input type="string" class="form-control" id="LastName" name="LastName">
											<span id="helpBlock" class="help-block">Last name of the customer</span>
											<label for="MiddleName">Middle Name:</label>
											<input type="string" class="form-control" id="MiddleName" name="MiddleName">
											<span id="helpBlock" class="help-block">Middle name of the customer</span>
											<label for="CompanyName">Company Name:</label>
											<input type="string" class="form-control" id="CompanyName" name="CompanyName">
											<span id="helpBlock" class="help-block">Company name of the customer</span>
											<label for="PhoneNum">Phone Number:</label>
											<input type="tel" class="form-control" id="PhoneNum" name="PhoneNum">
											<span id="helpBlock" class="help-block">Phone Number of the customer</span>
											<label for="Ext">Phone Ext:</label>
											<input type="number" min="0" class="form-control" id="Ext" name="Ext">
											<span id="helpBlock" class="help-block">Company name of the customer</span>
										</div>
									</div>
									<div class="well">
										<h4>Internal System Information</h4>
										<div class="form-group">
											<label for="PartnerOrderID">Partner Order ID:</label>
											<input type="string" class="form-control" id="PartnerOrderID" name="PartnerOrderID">
											<span id="helpBlock" class="help-block">Partner Side Internal Order ID</span>
											<label for="PartnerItemID">Partner Item ID:</label>
											<input type="string" class="form-control" id="PartnerItemID" name="PartnerItemID">
											<span id="helpBlock" class="help-block">Partner Side Internal Item ID</span>
											<label for="PartnerProductName">Partner Product Name:</label>
											<input type="string" class="form-control" id="PartnerProductName" name="PartnerProductName">
											<span id="helpBlock" class="help-block">Partner Side Product Name</span>
										</div>
									</div>
									<div class="well">
										<h4>Document</h4>
										<div class="form-group">
											<label for="DocumentId">Document Id:</label>
											<input type="string" class="form-control" id="DocumentId" name="DocumentId">
											<span id="helpBlock" class="help-block">The Document Instruction URL</span>
											<label for="DocumentInstructionSourceUrl">Document Instruction Source Url:</label>
											<input type="url" class="form-control" id="DocumentInstructionSourceUrl" name="DocumentInstructionSourceUrl">
											<span id="helpBlock" class="help-block">The Document Instruction URL</span>
											<label for="DocumentInstructionVersion">Document Instruction Version:</label>
											<input type="number" min="0" class="form-control" id="DocumentInstructionVersion" name="DocumentInstructionVersion">
											<span id="helpBlock" class="help-block">Should be '2'</span>
										</div>
									</div>
									<p>
										<button type="submit" class="btn btn-sm btn-info dropdown" name="CreateFreeOrder">GO!</button>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Example Code</h3>
				</div>
				<div class="panel-body">
					<?php 
						if (isset($_POST['RemediationReceipts'])) 
						{ 
						echo'<pre>';
						show_source ("../exampleSnippets/GetRemediationReciepts.php");
						echo'</pre>';	
						}	
						if (isset($_POST['OrderCancelation'])) 
						{ 
						echo'<pre>';
						show_source ("../exampleSnippets/orderCancelation.php");
						echo'</pre>';	
						}		
						if (isset($_POST['CreateFreeOrder'])) 
						{ 
						echo'<pre>';
						show_source ("../exampleSnippets/createFreeOrder.php");
						echo'</pre>';	
						}		
						?> 
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Response</h3>
				</div>
				<div class="panel-body">
					<?php 
						if (isset($_POST['RemediationReceipts'])) 
						{		
						$OrderIds = htmlentities($_POST['RemediationOrderIds']);
						$Response = $CimpressOpen->GetRemediationReceipts($OrderIds);
						echo"<pre>";
						echo json_encode($Response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
						echo"</pre>";			  
						} 
						if (isset($_POST['OrderCancelation'])) 
						{		
						$OrderId = htmlentities($_POST['CancelOrderID']);
						$Response = $CimpressOpen->CancelOrder($OrderId);
						
						echo"<pre>";
						echo 'Response code: ' . $Response;
						echo"</pre>";			  
						} 
						if (isset($_POST['CreateFreeOrder'])) 
						{		
						// Product Section
						$SKU = htmlentities($_POST['SKU']);
						$Quantity = htmlentities($_POST['Quantity']);
						
						// Address Section
						$AddressLine1 = htmlentities($_POST['AddressLine1']);
						$AddressLine2 = htmlentities($_POST['AddressLine2']);
						$City = htmlentities($_POST['City']);
						$StateRegion = htmlentities($_POST['StateRegion']);
						$PostalCode = htmlentities($_POST['PostalCode']);
						$CountryCode = htmlentities($_POST['CountryCode']);
						$DeliveryOptionId = htmlentities($_POST['DeliveryOptionId']);
						
						
						// Customer Info section
						$FirstName = htmlentities($_POST['FirstName']);
						$LastName = htmlentities($_POST['LastName']);
						$MiddleName = htmlentities($_POST['MiddleName']);
						$CompanyName = htmlentities($_POST['CompanyName']);
						$PhoneNum = htmlentities($_POST['PhoneNum']);
						$Ext = htmlentities($_POST['Ext']);
						
						// Partner Sys info section
						$PartnerOrderID = htmlentities($_POST['PartnerOrderID']);
						$PartnerItemID = htmlentities($_POST['PartnerItemID']);
						$PartnerProductName = htmlentities($_POST['PartnerProductName']);
						
						// Document section
						$DocumentId = htmlentities($_POST['DocumentId']);
						$DocumentInstructionSourceUrl = htmlentities($_POST['DocumentInstructionSourceUrl']);
						$DocumentInstructionVersion = htmlentities($_POST['DocumentInstructionVersion']);
						
						
						
						$Response = $CimpressOpen->PlaceFreeOrder($SKU, $Quantity,
						$AddressLine1, $AddressLine2, $City, $StateRegion, $PostalCode, $CountryCode, $DeliveryOptionId,
						$FirstName, $LastName, $MiddleName, $CompanyName, $PhoneNum, $Ext,
						$PartnerOrderID, $PartnerItemID, $PartnerProductName,
						$DocumentId, $DocumentInstructionSourceUrl, $DocumentInstructionVersion);
						echo"<pre>";
						echo json_encode($Response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
						echo"</pre>";			  
						}
						?>
				</div>
			</div>
		</div>
	</div>
</div>
