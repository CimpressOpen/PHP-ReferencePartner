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
				<li class="active"><a href="Products.php">Products</a></li>
				<li><a href="Documents.php">Documents</a></li>
				<li><a href="DeliveryOptions.php">Delivery Options</a></li>
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
								<a data-toggle="collapse" href="#collapse1">Get All Products</a>
							</h4>
						</div>
						<div id="collapse1" class="panel-collapse collapse">
							<div class="panel-body">
								<form method="POST" action="">
									<p>
										<button type="submit" class="btn btn-sm btn-info dropdown" name="AllProducts">GO!</button>
									</p>
								</form>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#collapse2">Get Product Pricing</a>
							</h4>
						</div>
						<div id="collapse2" class="panel-collapse collapse">
							<div class="panel-body">
								<form method="POST" action="">
									<p>
										<button type="submit" class="btn btn-sm btn-info dropdown" name="Pricing">GO!</button>
									</p>
								</form>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#collapse3">Get Product Surfaces</a>
							</h4>
						</div>
						<div id="collapse3" class="panel-collapse collapse">
							<div class="panel-body">
								<form method="POST" action="">
									<label for="SKU">SKU:</label>
									<p>
									<div class="radio">
										<label><input type="radio" name="rdb" value ="VIP-45229">VIP-45229 Business Cards NA - Premium Glossy</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="rdb" value ="VIP-47735">VIP-47735 Mug</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="rdb" value ="VIP-45694">VIP-45694 Matte Poster Stock</label>
									</div>
									<div class="radio">
										<label><input type="radio" checked="checked" name="rdb" value="Other">Other <input type="text" name="other_reason" ></label>
									</div>
									<button type="submit" class="btn btn-sm btn-info" name="Surfaces">Get Product Surfaces</button>			
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
						if (isset($_POST['AllProducts'])) 
						{ 
						echo'<pre>';
						show_source ("../exampleSnippets/getAllProducts.php");
						echo'</pre>';	
						}  
						if (isset($_POST['Pricing'])) 
						{ 
						echo'<pre>';
						show_source ("../exampleSnippets/getProductPricing.php");
						echo'</pre>';	
						}  
						if (isset($_POST['Surfaces'])) 
						{ 
						echo'<pre>';
						show_source ("../exampleSnippets/getProductSurfaces.php");
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
						if (isset($_POST['AllProducts'])) 
						{		
						$Response = $CimpressOpen->getProducts();		
						echo"<pre>";
						echo json_encode($Response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
						echo"</pre>";		  
						} 
						if (isset($_POST['Pricing'])) 
						{ 
						$Response = $CimpressOpen->getProductPricing();		
						echo"<pre>";
						echo json_encode($Response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
						echo"</pre>";	
						}  
						if (isset($_POST['Surfaces'])) 
						{ 
						$SKU = htmlentities($_POST['rdb']);
						if($SKU == 'Other'){
						$SKU = htmlentities($_POST['other_reason']);
						}
						
						echo "You have selected :" . $SKU;  //  Displaying Selected Value
						
						$Response = $CimpressOpen->getProductSides($SKU);		
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