<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
 $id = $_GET['editid'];
$clientmsaid=$_SESSION['clientmsaid'];

 $name=$_POST['name'];
 $ctNumber=$_POST['ctnumber'];
 $address=$_POST['address'];
 $packageType=$_POST['packagetype'];
 $ip=$_POST['ip'];

$sql="UPDATE tblclient SET Name=:name,Address=:address,Ip=:ip,ContactNumber=:ctNumber,Package=:packageType WHERE UserID=:id";
$query=$dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':ip',$ip,PDO::PARAM_STR);
$query->bindParam(':ctNumber',$ctNumber,PDO::PARAM_STR);
$query->bindParam(':packageType',$packageType,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$insert =  $query->execute();

   // $LastInsertId=$dbh->lastInsertId();
   if ($insert) {
    echo '<script>alert("Client has been Updated.")</script>';
echo "<script>window.location.href ='add-client.php'</script>";
  }
  else
    {
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
								<a href="#">Update Client</a>
							</li>
							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Update Client</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6 col-lg-8">
										 <form method="post" >
<?php 
$id = $_GET['editid'];
$sql="SELECT * FROM tblclient WHERE UserID=:id";
$query = $dbh -> prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>										 	
											<div class="form-group">
												<label for="text">Client Name</label>
												<input type="text" class="form-control" value="

						<?php echo htmlentities($row->Name) ?>" name="name" id="text" required="true" placeholder="Client Name">
											</div>
											<div class="form-group">
												<label for="text">Contact Number</label>
												<input type="text" class="form-control" name="ctnumber" id="text" value="<?php echo htmlentities($row->ContactNumber) ?>" required="true" placeholder="Contact Number">
											</div>
											<div class="form-group">
												<label for="comment">Address</label>
												<div class="form-group"><input type="text" name="address" value="<?php  echo htmlentities($row->Address);?>" class="form-control" required='true'> </div>
											</div>

											<div class="form-group">
												<label for="text">Ip Address</label>
												<input type="text" class="form-control" id="text" value="<?php echo htmlentities($row->Ip) ?>" name="ip" required="true" placeholder="Ip Address">
											</div>
											<?php }} ?>
											<div class="form-group">
												<label for="exampleFormControlSelect1">Package Type</label>
												<select name="packagetype" class="form-control" id="exampleFormControlSelect1">
													<option value="">Select Package</option>
<?php 
$sql="SELECT * from tblservices";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
<option value="<?php  echo htmlentities($row->ServiceName);?>"><?php  echo htmlentities($row->ServiceName);?></option>
<?php } } ?>													
												
												</select>
											</div>


											<div class="form-group">
												<label for="text">Password</label>
												<input type="text" name="password" class="form-control" id="tet" required="true" placeholder="Client Password">
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