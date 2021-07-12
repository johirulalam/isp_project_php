<?php
session_start();
error_reporting(0); 
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
 $id=$_GET['employeeId'];
 $clientmsaid=$_SESSION['clientmsaid'];
 
 $employeeName=$_POST['employeename'];
 $employeeNumber=$_POST['employeenumber'];
 $employeeAddress=$_POST['employeeaddress'];

$sql="UPDATE tblemployee SET EmployeeName=:employeeName,EmployeeNumber=:employeeNumber,EmployeeAddress=:employeeAddress WHERE EmployeeId=:id";
$query=$dbh->prepare($sql);
$query->bindParam(':employeeName',$employeeName,PDO::PARAM_STR);
$query->bindParam(':employeeNumber',$employeeNumber,PDO::PARAM_STR);
$query->bindParam(':employeeAddress',$employeeAddress,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$result = $query->execute();
   
   // $lastInsertId= $dbh->lastInsertId();
   if($result) {
    echo '<script>alert("Employee Update successful")</script>';
	echo "<script>window.location.href ='employee-list.php'</script>";
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
								<a href="#">Update Employee</a>
							</li>
							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Update Employee</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6 col-lg-8">
										 <form method="post" >
<?php
$id = $_GET['employeeId'];
$sql="SELECT * FROM tblemployee WHERE EmployeeId=:id";
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
												<label for="text">Employee Name</label>
												<input type="text" value="<?php  echo htmlentities($row->EmployeeName);?>" name="employeename" class="form-control" id="tet" required="true" placeholder="Employee Name">
											</div>

											<div class="form-group">
												<label for="text">Contact Number</label>
												<input type="text" required="true" value="<?php  echo htmlentities($row->EmployeeNumber);?>" name="employeenumber" class="form-control" id="text" placeholder="Contact Number">
											</div>
											<div class="form-group">
												<label for="comment">Address</label>
												<input type="text" name="employeeaddress" value="<?php  echo htmlentities($row->EmployeeAddress);?>" class="form-control" required='true'>
											</div>
<?php }} ?>
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