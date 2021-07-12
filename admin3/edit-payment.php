<?php
session_start();
error_reporting(0); 
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
$id = $_GET['id'];
 $clientmsaid=$_SESSION['clientmsaid'];
 $clientId=$_POST['clientid'];
 $bill=$_POST['bill'];
 $collectedBy=$_POST['collectedby'];
 
$sql="UPDATE tblpaid SET UserID=:clientId,PaidBill=:bill,CollectedBy=:collectedBy WHERE id=:id";
$query=$dbh->prepare($sql);
$query->bindParam(':clientId',$clientId,PDO::PARAM_STR);
$query->bindParam(':bill',$bill,PDO::PARAM_STR);
$query->bindParam(':collectedBy',$collectedBy,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$result = $query->execute();
   
   // $lastInsertId= $dbh->lastInsertId();
   if($result) {
    echo '<script>alert("Update Payment successful")</script>';
	echo "<script>window.location.href ='paid-bill.php'</script>";
  }
  else{
        echo '<script>alert("Something Went Wrong. Please try again")</script>'; 	
    }

  
}

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
								<a href="#">Update Payment</a>
							</li>
							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Update Payment</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6 col-lg-8">
										 <form method="post" >
										 	<div class="form-group">
												<label for="exampleFormControlSelect1">Client Id</label>
												<select name="clientid" required="true" class="form-control" id="exampleFormControlSelect1">
													<option value="">Select Client Id & Name</option>
<?php 
 
$sql="SELECT * from tblclient";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{  ?>												
													<option value="<?php  echo htmlentities($row->UserID);?>"><?php  echo "ID: ". htmlentities($row->UserID)." Name: ".htmlentities($row->Name);?>			
		                                            </option>
<?php $cnt=$cnt+1;}} ?>	
													
												</select>
											</div>
											<div class="form-group">
												<label for="number">Bill</label>
												<input type="number" name="bill" class="form-control" id="number" required="true" placeholder="0">
											</div>

											<div class="form-group">
												<label for="exampleFormControlSelect1">Client Id</label>
												<select name="collectedby" class="form-control" id="exampleFormControlSelect1">
													<option value="">Choose Employee Name</option>
<?php 
 
$sql="SELECT * from tblemployee";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{  ?>												
													<option value="<?php  echo htmlentities($row->EmployeeName);?>"><?php  echo htmlentities($row->EmployeeName);?>			
		                                            </option>

<?php $cnt=$cnt+1;}} ?>	
												</select>
											</div>


											<div class="form-group">
												<button type="submit" class="btn btn-sm btn-success" name="submit" id="submit">Update</button>
											</div>
										</form>

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
	
</body>
</html>
<?php }  ?>