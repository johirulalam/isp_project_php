<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
  header('location:logout.php');
  } else{
  	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once('includes/header.php');?>
</head>
<body>
	<div class="wrapper">
	
		<!-- Sidebar -->
		<?php include_once('includes/sidebar.php');?>
		<!-- End Sidebar -->








		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
					
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="dashboard.php">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							
							<li class="nav-item">
								<a href="#">Paid Details</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Paid Details</h4>
								</div>
								<div class="card-body">
<?php
$id = $_GET['userId'];
$sql="SELECT DISTINCT Name FROM tblclient WHERE UserID=:id ";
$query = $dbh -> prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
	<div>
		<h2>MR. <?php echo htmlentities($row->Name); ?></h2>
	</div>

<?php }} ?>								
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead> <tr>
									 
									  <th>PAYMENT</th>
									  <th>DATE</th>
									  </tr>
									   </thead>
									    <tbody>
<?php  	
$id = $_GET['userId'];
$sql="SELECT * FROM tblclient,tblpaid WHERE tblclient.UserID=:id AND tblpaid.UserID=:id";
$query = $dbh -> prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $row)
{      
	$totalPaid = $totalPaid + $row->PaidBill;
	$totalDue  = $row->Due;
	$month = $row->Subscription;
	
         ?>
									     <tr class="active">
									     
									        <td><?php  echo htmlentities($row->PaidBill);?></td>

									         <td><?php  echo htmlentities($row->CreationDate);?></td> 
									         
								       
									     </tr>
									     <?php $cnt=$cnt+1;}} ?>
									     </tbody> </table> 
									      <h1>Total Subscription: <?php

									     echo $month; ?></h1>
									     <h2>Total Paid: <?php
if (empty($totalPaid)) {
	$totalPaid = 0;
}
									     echo $totalPaid; ?></h2>
									      <h2>Total Due: <?php echo $totalDue-$totalPaid; ?></h2>

									</div>
								</div>
							</div>
						</div>

						
					</div>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					
					<div class="copyright ml-auto">
						<i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
					</div>				
				</div>
			</footer>
		</div>
         

















			<footer class="footer">
				<div class="container-fluid">
					
					<div class="copyright ml-auto">
						<i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
					</div>				
				</div>
			</footer>
		</div>
		
	
	</div>
	
	<?php include_once('includes/footer.php');?>
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
</body>
</html>
<?php }  ?>