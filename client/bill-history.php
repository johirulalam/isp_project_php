<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsuid']==0)) {
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
								<a href="#">Bill History</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Bill History</h4>
								</div>
<!--//sub-heard-part-->
					<div class="graph-visual tables-main">
				
					<div class="graph-visual tables-main" id="exampl">
					<div>
						<h1>SPEEDNET24</h1>
						<span>SpeedNet24 Sp.z oo,Nad Nadem 4A street 96-325 Stare Budy Radziejowskie</span><br>
						<span>speednet24.com, biuro@speednet24.com</span><br>
						<span>+48 511 61 00 16</span>
					</div>
<?php
$uid=$_SESSION['clientmsuid'];
$sql="select * from tblclient where UserId=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);


if($query->rowCount() > 0)
{
foreach($results as $row)
{     ?>
						<h3 class="inner-tittle two">Billed To: </h3>
						<span>Name: <?php echo htmlentities($row->Name); ?></span><br>
						<span>Ip: <?php echo htmlentities($row->Ip); ?></span><br>
						<span>Address: <?php echo htmlentities($row->Address); ?></span><br>
						<span>Name: <?php echo htmlentities($row->ContactNumber); ?></span><br>
						<div class="graph">
<?php }} ?>								
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Serial Number</th>
													<th>Date</th>
													<th>Payment</th>
													<th>Collected By</th>
																	
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Serial Number</th>
													<th>Date</th>
													<th>Payment</th>
													<th>Collected By</th>								
												</tr>
											</tfoot>
											<tbody>
<?php
									    	$uid=$_SESSION['clientmsuid'];
$sql="select distinct tblclient.Name,tblpaid.PaidBill,tblpaid.CreationDate,tblpaid.CollectedBy, tblclient.Due from  tblclient   
	join tblpaid on tblclient.UserID=tblpaid.UserID  where tblpaid.UserId=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{         

$totalPaid = $totalPaid + $row->PaidBill;
$totalBill = $row->Due;
      ?>												
												<tr>
													<td><?php echo htmlentities($cnt);?></td>
													<td><?php  echo htmlentities($row->CreationDate);?></td>
													<td style="text-align: center;"><?php  echo htmlentities($row->PaidBill);?></td>
													<td><?php  echo htmlentities($row->CollectedBy);?></td>
													
													
												</tr>
 <?php $cnt=$cnt+1;}} ?>
											</tbody>
										</table>
  <h3>Total Paid: <?php echo $totalPaid; ?></h3>
									     <h3>Due: <?php
$due = $totalBill - $totalPaid;									     
if (empty($due)) {
	$due = 0;
}
									      echo $due;
echo "<br><br><br><br>Print Date: ". date("d/m/Y");									       ?></h3>
									   <p style="margin-top:1%"  align="center">
  <i class="fa fa-print fa-2x" style="cursor: pointer;"  OnClick="CallPrint(this.value)" ></i>
</p>										
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
	<script>
function CallPrint(strid) {
var prtContent = document.getElementById("exampl");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>
</body>
</html>
<?php } ?>