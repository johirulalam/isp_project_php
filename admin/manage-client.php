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
								<a href="#">Clients List</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Clients List</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													
													<th>Client Name</th>
													<th>Address</th>
													<th>Contact Number</th>	
													<th>Registration Date</th>
													<th>Package</th>
													<th>Ip</th>
													<th>Acount Status</th>
													<th>Action</th>													
												</tr>
											</thead>
											<tfoot>
												<tr>
													
													<th>Client Name</th>
													<th>Address</th>
													<th>Contact Number</th>	
													<th>Registration Date</th>
													<th>Package</th>
													<th>Ip</th>
													<th>Acount Status</th>
													<th>Action</th>													
												</tr>
											</tfoot>
											<tbody>
<?php
$sql="SELECT * from tblclient";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>												
												<tr>
													<!-- <th><?php echo htmlentities($cnt);?></th> -->
													
													<td><?php  echo htmlentities($row->Name);?></td>
													<td><?php  echo htmlentities($row->Address);?></td>
													<td><?php  echo htmlentities($row->ContactNumber);?></td>
													<td><?php  echo htmlentities($row->CreationDate);?></td>
													<td><?php  echo htmlentities($row->Package);?></td>
													<td><?php  echo htmlentities($row->Ip);?></td>
													<td style="color:green"><b><?php  echo htmlentities($row->AccountType);?></b></td>
									          
									        <td><a href="edit-client-details.php?editid=<?php echo $row->UserID;?>" class="btn btn-sm btn-primary">Edit</a>
<?php 
    $account = $row->AccountType;
	if($account == "Active") { ?>
		<a href="inactive-date.php?InActiveId=<?php echo $row->UserID;?>" class="btn btn-sm btn-danger">Inactive</a>
<?php }else{ ?>
<a href="active-date.php?activeId=<?php echo $row->UserID;?>" class="btn btn-sm btn-success">Active</a>
<?php } ?>
												</tr>
												<?php $cnt=$cnt+1;}} ?>
											</tbody>
										</table>
									</div>
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