<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
  header('location:logout.php');
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
					<!-- Card -->
					<h4 class="page-title">Dashboard</h4>
					<div class="row">
						<div class="col-sm-6 col-md-4">
							<div class="card card-stats card-primary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
<?php 
$sql ="SELECT * from tblclient";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$tclients=$query->rowCount();
?>										
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Total Clients</p>
												<h4 class="card-title"><?php echo htmlentities($tclients);?></h4>
											</div>
										</div>
										<div class="col-5">
											<div class=" text-center">
												<a href="manage-client.php">
												<span class=" btn btn-sm btn-success text-center">Read More</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="card card-stats card-info card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-interface-6"></i>
											</div>
										</div>
<?php 
$sql1 ="SELECT * from tblservices ";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$tser=$query1->rowCount();
?>											
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Total Package</p>
												<h4 class="card-title"><?php echo htmlentities($tser);?></h4>
											</div>
										</div>
										<div class="col-5">
											<div class=" text-center">
												<a href="">
												<span class=" btn btn-sm btn-success text-center">Read More</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="card card-stats card-success card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-analytics"></i>
											</div>
										</div>
<?php
$sql6="select  sum(tblpaid.PaidBill) as todaysale
 from tblpaid 
  where date(CreationDate)=CURDATE()";

  $query6 = $dbh -> prepare($sql6);
  $query6->execute();
  $results6=$query6->fetchAll(PDO::FETCH_OBJ);
  foreach($results6 as $row6)
{

$todays_sale=$row6->todaysale;
}


  ?>										
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Today Paid</p>
												<h4 class="card-title"><?php
if (empty($todays_sale)) {
	$todays_sale = 0;
}
								 echo "$ ". $todays_sale;?></h4>
											</div>
										</div>
										<div class="col-5">
											<div class=" text-center">
												<a href="paid-bill.php">
												<span class=" btn btn-sm btn-secondary text-center">Read More</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
						<div class="row">
						<div class="col-sm-6 col-md-4">
							<div class="card card-stats card-secondary card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-success"></i>
											</div>
										</div>
<?php
$sql7="select * from tblemployee";

$query7 = $dbh -> prepare($sql7);
$query7->execute();
$results7=$query7->fetchAll(PDO::FETCH_OBJ);
$temployee=$query7->rowCount();
?>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Total Employee</p>
												<h4 class="card-title"><?php echo htmlentities($temployee);?></h4>
											</div>
										</div>
										<div class="col-5">
											<div class=" text-center">
												<a href="employee-list.php">
												<span class=" btn btn-sm btn-success text-center">Read More</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					

					
						<div class="col-sm-6 col-md-4">
							<div class="card card-stats card-primary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
<?php
$sql8="select sum(tblclient.Due) as totalbill
 from tblclient 
  ";
$sql9="select sum(tblclient.Due) as totalbill, sum(tblpaid.PaidBill) as totalpaid
 from tblclient 
  join tblpaid on tblclient.UserID=tblpaid.UserID";
  $query8 = $dbh -> prepare($sql8);
  $query8->execute();
  $results8=$query8->fetchAll(PDO::FETCH_OBJ);
  foreach($results8 as $row8)
{

$totalBill=$row8->totalbill; 
}


$sql19="select sum(tblpaid.PaidBill) as totalpaid
 from tblpaid";
  $query19 = $dbh -> prepare($sql19);
  $query19->execute();
  $results19=$query19->fetchAll(PDO::FETCH_OBJ);
  foreach($results19 as $row19)
{

$totalPaid= $row19->totalpaid; 
}

$due = $totalBill - $totalPaid;
  ?>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Total Due</p>
												<h4 class="card-title"><?php echo "$ ". $due;?></h4>
											</div>
										</div>
										<div class="col-5">
											<div class=" text-center">
												<a href="due-bill.php">
												<span class=" btn btn-sm btn-success text-center">Read More</span>
												</a>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="card card-stats card-info card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-interface-6"></i>
											</div>
										</div>
<?php
$sql9="select  sum(tblpaid.PaidBill) as totalpaid
 from tblpaid";

  $query9 = $dbh -> prepare($sql9);
  $query9->execute();
  $results9=$query9->fetchAll(PDO::FETCH_OBJ);
  foreach($results9 as $row9)
{

$totalPaid=$row9->totalpaid;
}
  ?>
	
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Total Paid</p>
												<h4 class="card-title"><?php echo "$ ". $totalPaid;?></h4>
											</div>
										</div>
										<div class="col-5">
											<div class=" text-center">
												<a href="paid-bill.php">
												<span class=" btn btn-sm btn-success text-center">Read More</span>
												</a>
											</div>
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