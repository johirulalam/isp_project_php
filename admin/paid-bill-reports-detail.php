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
								<a href="#">Paid Bill Report</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Paid Bill Report</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
						<div class="tables">
								 <?php
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
$rtype=$_POST['requesttype'];
?>
<?php if($rtype=='mtwise'){
$month1=strtotime($fdate);
$month2=strtotime($tdate);
$m1=date("F",$month1);
$m2=date("F",$month2);
$y1=date("Y",$month1);
$y2=date("Y",$month2);
    ?>
<h4 class="header-title m-t-0 m-b-30">Paid Bill Report Month Wise</h4>
<h4 align="center" style="color:blue">Paid Bill Report  from <?php echo $m1."-".$y1;?> to <?php echo $m2."-".$y2;?></h4>
<hr />
								<table class="table" border="1"> <thead> <tr>  
									<th>S.NO</th>
<th>Month / Year </th>
<th>Sales</th>
									  </tr>
									   </thead>
									    <tbody>
									    	<?php
$sql="select month(CreationDate) as lmonth,year(CreationDate) as lyear,sum(PaidBill) as totalpaid from  tblpaid where date(tblpaid.CreationDate) between '$fdate' and '$tdate' group by lmonth,lyear";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
									     <tr class="active">
									      <th scope="row"><?php echo htmlentities($cnt);?></th>
									       
									       <td><?php  echo  $row->lmonth."/".$row->lyear;?></td>
									       <td><?php  echo "$".$total=$row->totalpaid;?></td>
									        
									     </tr>
									     <?php
									     $ftotal+=$total;
									      $cnt=$cnt+1;}} ?>
									      <tr>
                  <td colspan="2" align="center">Total </td>
              <td><?php  echo "$".$ftotal;?></td>
   
                 
                 
                </tr>
									     </tbody> </table>
									     <?php } else {
$year1=strtotime($fdate);
$year2=strtotime($tdate);
$y1=date("Y",$year1);
$y2=date("Y",$year2);
 ?>
 <h4 class="header-title m-t-0 m-b-30">Paid Bill Report Year Wise</h4>
    <h4 align="center" style="color:blue">Paid Bill Report  from <?php echo $y1;?> to <?php echo $y2;?></h4>
    <hr /> 
    <table class="table" border="1"> <thead> <tr>  
									<th>S.NO</th>
<th>Month / Year </th>
<th>Sales</th>
									  </tr>
									   </thead>
									    <tbody>
									    	<?php
$sql="select year(CreationDate) as lyear,sum(PaidBill) as totalpaid from  tblpaid where date(tblpaid.CreationDate) between '$fdate' and '$tdate' group by lyear";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
									     <tr class="active">
									      <th scope="row"><?php echo htmlentities($cnt);?></th>
									       
									       <td><?php  echo  $row->lyear;?></td>
									       <td><?php  echo "$".$total=$row->totalpaid;?></td>
									        
									     </tr>
									     <?php
									     $ftotal+=$total;
									      $cnt=$cnt+1;}} }?>
									      <tr>
                  <td colspan="2" align="center">Total </td>
              <td><?php  echo "$".$ftotal;?></td>
   
                 
                 
                </tr>
									     </tbody> </table>
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