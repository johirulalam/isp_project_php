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
								<a href="#">Due Bill</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Due Bill</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Serial Number</th>
													<th>Client Name</th>
													<th>User Id</th>
													<th>Contact Number</th>
													<th>Due Bill</th>
													<th>Action</th>													
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Serial Number</th>
													<th>Client Name</th>
													<th>User Id</th>
													<th>Contact Number</th>
													<th>Due Bill</th>
													<th>Action</th>													
												</tr>
											</tfoot>
											<tbody>
<?php
$sql="SELECT * FROM tblclient, tblservices WHERE tblclient.Package=tblservices.ServiceName";

$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{         

$due = $row->Due; 

if($row->AccountType==="Active") {

	$lastAddBillDate = $row->LastAddBillDate;
	$lastActiveDate  = $row->LastActiveDate;

	if($lastAddBillDate>=$lastActiveDate){
		$startDate   = $row->LastAddBillDate;
		$month  = $row->Subscription + 1;
	} else{
		$startDate = $row->LastActiveDate;
		$month  = $row->Subscription + 1;
	}
		 
		$currentDate = date("Y-m-d");
$date = strtotime("$startDate");
$addBillDate = date("Y-m-d", strtotime("+1 month", $date));
 
		if($currentDate>$addBillDate) {
			
			// $startDate = $addBillDate;
			$due = $row->Due;
			$due = $due + $row->ServicePrice;
			$AccountID = $row->AccountID;
			

			$sqlDue="UPDATE tblclient SET Due=:due, LastAddBillDate=:addBillDate, Subscription=:month  WHERE AccountID=:AccountID";
			$query = $dbh->prepare($sqlDue);
			$query->bindParam(':due',$due,PDO::PARAM_STR);
			$query->bindParam(':addBillDate',$addBillDate,PDO::PARAM_STR);
			$query->bindParam(':month',$month,PDO::PARAM_STR);
			$query->bindParam(':AccountID',$AccountID,PDO::PARAM_STR);
			$query->execute();
		}
	}
 ?>												
												<tr>
													<td><?php echo htmlentities($cnt);?></td>
													<td><?php  echo htmlentities($row->Name);?></td>
													<th><?php echo htmlentities($row->UserID);?></th>
													<td><?php  echo htmlentities($row->ContactNumber);?></td>
<?php 

$id = $row->UserID;   
$sql="SELECT * from tblpaid WHERE UserID=:id";
$query = $dbh -> prepare($sql);

$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$result2=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
foreach($result2 as $row2)
{
 $due = $row->Due; 


  $totalPaid = $totalPaid + $row2->PaidBill;     

     ?>
									     
<?php }}  ?>	
<?php if ($totalPaid>0) {
	$totalDue = $due - $totalPaid;
} else{
	$totalDue = $due - $totalPaid;
}
?>

													<td><?php  echo $totalDue;?></td>
<?php $totalDue=0; $totalPaid =0; ?>													
													<td>
									       <a href="client-details.php?userId=<?php  echo $row->UserID;?>"class="btn btn-sm btn-info"> View </a>
									       </td>													
													
													
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