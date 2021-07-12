<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['clientmsuid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$uid=$_SESSION['clientmsuid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT UserID FROM tblclient WHERE UserID=:uid and Password=:cpassword";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

if($query -> rowCount() > 0)
{
$con="update tblclient set Password=:newpassword where UserID=:uid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':uid', $uid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();

echo '<script>alert("Your password successully changed")</script>';
echo "<script>window.location.href ='change-password.php'</script>";
} else {
echo '<script>alert("Your current password is wrong")</script>';

}
}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once('includes/header.php');?>
	<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   

</script>
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
								<a href="#">Change Password</a>
							</li>
							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Change Password</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6 col-lg-8">
										 <form name="changepassword" method="post" onsubmit="return checkpass();" action="" >
											<div class="form-group">
												<label for="password">Current Password</label>
												<input type="password" class="form-control" id="password" name="currentpassword" required="true" placeholder="Current Password">
											</div>

											<div class="form-group">
												<label for="password">New Password</label>
												<input type="password" name="newpassword" required="true" class="form-control" id="password" placeholder="New Password">
											</div>

											<div class="form-group">
												<label for="password">Confirm Password</label>
												<input type="password" required="true" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-sm btn-success" name="submit" id="submit">Change</button>
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