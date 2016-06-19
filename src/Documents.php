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
				<li class="active"><a href="Documents.php">Documents</a></li>
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
								<a data-toggle="collapse" href="#collapse1">Document Preview</a>
							</h4>
						</div>
						<div id="collapse1" class="panel-collapse collapse">
							<div class="panel-body">
								<form method="POST" action="">
									<div class="form-group">
										<label for="SKU1">Product SKU:</label>
										<input type="text" class="form-control" id="SKU1" name="SKU1">
									</div>
									<div class="form-group">
										<label for="InstructURL">Instruction Source URL:</label>
										<input type="url" class="form-control" id="InstructURL" name="InstructURL1">
									</div>
									<div class="form-group">
										<label for="Width">Width:</label>
										<input type="number" min="0" class="form-control" id="Width" name="Width">
										<span id="helpBlock" class="help-block">The width of the document preview</span>
									</div>
									<p>
										<button type="submit" class="btn btn-sm btn-info dropdown" name="DocumentPreview">GO!</button>
									</p>
								</form>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#collapse2">Create Document URL</a>
							</h4>
						</div>
						<div id="collapse2" class="panel-collapse collapse">
							<div class="panel-body">
								<form method="POST" action="">
									<div class="form-group">
										<label for="SKU2">Product SKU:</label>
										<input type="text" class="form-control" id="SKU2" name="SKU2">
									</div>
									<div class="form-group">
										<label for="URL1">URL:</label>
										<input type="url" class="form-control" id="URL1" name="subjectURL">
										<span id="helpBlock" class="help-block">The url of the image you want on the product</span>
									</div>
									<p>
										<button type="submit" class="btn btn-sm btn-info dropdown" name="DocURL">GO!</button>
									</p>
								</form>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#collapse3">Create Document Upload</a>
							</h4>
						</div>
						<div id="collapse3" class="panel-collapse collapse">
							<div class="panel-body">
								<form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data">
									<div class="form-group">
										<label for="SKU3">Product SKU:</label>
										<input type="text" class="form-control" id="SKU3" name="SKU3">
										<label for="MultipagePdf">MultipagePdf:</label><br>
										<input type="checkbox" name="MultipagePdf"><br><br>
										<label for="SKU3">Product SKU:</label><br>
										<label class="btn btn-default btn-file">
										Browse File Upload<input name="fileToUpload" id="fileToUpload" type="file" style="display: none;">
										</label>
									</div>
									<p>
										<button type="submit" class="btn btn-sm btn-info" name="DocUpload">GO!</button>
									</p>
								</form>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#collapse4">Edit Document</a>
							</h4>
						</div>
						<div id="collapse4" class="panel-collapse collapse">
							<div class="panel-body">
								<form method="POST" action="">
									<div class="form-group">
										<label for="DocId">Document ID:</label>
										<input type="text" class="form-control" id="DocId" name="DocId">
									</div>
									<div class="form-group">
										<label for="SurfaceName">Surface Name:</label>
										<input type="string" class="form-control" id="SurfaceName" name="SurfaceName">
										<label for="Rotation">Rotation:</label>
										<input type="number" min="0" class="form-control" id="Rotation" name="Rotation">
										<span id="helpBlock" class="help-block">Degrees of rotation</span>
									</div>
									<p>
										<button type="submit" class="btn btn-sm btn-info dropdown" name="EditDocument">GO!</button>
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
						if (isset($_POST['DocumentPreview'])) 
						{ 
						echo'<pre>';
						show_source ("../exampleSnippets/getDocumentPreview.php");
						echo'</pre>';	
						}  
						if (isset($_POST['DocURL'])) 
						{ 
						echo'<pre>';
						show_source ("../exampleSnippets/documentUrl.php");
						echo'</pre>';	
						}  
						if (isset($_POST['DocUpload'])) 
						{ 
						echo'<pre>';
						show_source ("../exampleSnippets/documentUpload.php");
						echo'</pre>';	
						}  
						if (isset($_POST['EditDocument'])) 
						{ 
						echo'<pre>';
						show_source ("../exampleSnippets/modifyDocument.php");
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
						if (isset($_POST['DocumentPreview'])) 
						{		
						$SKU = htmlentities($_POST['SKU1']);
						$DocURL = htmlentities($_POST['InstructURL1']);
						$Width = htmlentities($_POST['Width']);
						$Response = $CimpressOpen->GetDocumentPreview($SKU, $DocURL, $Width);
						echo"<pre>";
						echo json_encode($Response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
						echo"</pre>";			  
						} 
						if (isset($_POST['DocURL'])) 
						{ 
						$SKU = htmlentities($_POST['SKU2']);
						$ImageURL = htmlentities($_POST['subjectURL']);
						$Response = $CimpressOpen->CreateDocumentURL($SKU, $ImageURL);
						echo"<pre>";
						echo json_encode($Response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
						echo"</pre>";	
						}
						if (isset($_POST['DocUpload'])) 
						{ 
						$SKU = htmlentities($_POST['SKU3']);
						$File = $_FILES['fileToUpload']['tmp_name'];
						$MultipagePdf = null;
						if(isset($_POST['MultipagePdf'])){
							$MultipagePdf = htmlentities($_POST['MultipagePdf']);
						}
						if($MultipagePdf == 'on'){
							$MultipagePdf = 'true';
						}
						else{
							$MultipagePdf = 'false';
						}
						echo $MultipagePdf;
						$Response = $CimpressOpen->CreateDocumentUpload($SKU, $File, $MultipagePdf);
						echo"<pre>";
						echo json_encode($Response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
						echo"</pre>";	
						}  
						if (isset($_POST['EditDocument'])) 
						{ 
						$DocumentID = htmlentities($_POST['DocId']);
						$SurfaceName = htmlentities($_POST['SurfaceName']);
						$RotationDegrees = htmlentities($_POST['Rotation']);
						$Response = $CimpressOpen->ModifyDocument($DocumentID, $SurfaceName, $RotationDegrees);
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