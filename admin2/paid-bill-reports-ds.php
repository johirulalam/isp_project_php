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
								<a href="#">Paid Bill Reports</a>
							</li>
							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Paid Bill Reports</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6 col-lg-8">
										<form method="post" name="bwdatesreport"  action="paid-bill-reports-detail.php" enctype="multipart/form-data">
	
	<div class="form-group"> <label for="exampleInputEmail1">From Date</label> <input type="date" name="fromdate" id="fromdate" value="" class="form-control" required='true'> </div>
	<div class="form-group"> <label for="exampleInputEmail1">To Date</label> <input type="date" name="todate" id="todate" value="" class="form-control" required='true'> </div>
		<div class="form-group"> <label for="exampleInputPassword1">Request Type</label><input type="radio" name="requesttype" value="mtwise" checked="true">Month wise
                  <input type="radio" name="requesttype" value="yrwise">Year wise </div>
	 <button type="submit" class="btn btn-default" name="submit" id="submit">Submit</button> </form>  

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