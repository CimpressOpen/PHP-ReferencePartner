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
				<li class="active"><a href="DeliveryOptions.php">Delivery Options</a></li>
				<li><a href="Orders.php">Orders</a></li>
				<li><a href="Remediation.php">Remediation</a></li>
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
								<a data-toggle="collapse" href="#collapse1">Get Delivery Options</a>
							</h4>
						</div>
						<div id="collapse1" class="panel-collapse collapse">
							<div class="panel-body">
								<form method="POST" action="">
									<div class="well">
										<h4>Destination Address</h4>
										<div class="form-group">
											<br>
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
										</div>
									</div>
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
									<p>
										<button type="submit" class="btn btn-sm btn-info dropdown" name="DeliveryOptions">GO!</button>
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
						if (isset($_POST['DeliveryOptions'])) 
						{ 
						echo'<pre>';
						show_source ("../exampleSnippets/getDeliveryOptions.php");
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
						if (isset($_POST['DeliveryOptions'])) 
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
						
						
						
						$Response = $CimpressOpen->getDeliveryOptions($SKU, $Quantity,
						$AddressLine1, $AddressLine2, $City, $StateRegion, $PostalCode, $CountryCode);
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
