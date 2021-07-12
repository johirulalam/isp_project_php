<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsuid']==0)) {
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

		<?php
$uid=$_SESSION['clientmsuid'];
$sql="SELECT Name from  tblclient where UserID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
	
							







        <div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<!-- Card -->
					<h2 style="padding-left: 200px" class="page-title">Welcome to Client Panel !! <?php  echo $row->Name;?></h2>
					<?php $cnt=$cnt+1;}} ?>


						

					

						
						
					</div>


				</div>
			</div>
			



        

		
			<footer class="footer">
				<div class="container-fluid">
					
					<div class="copyright ml-auto">
						2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
					</div>				
				</div>
			</footer>
		</div>
		
	
	</div>
	
	<?php include_once('includes/footer.php');?>
</body>
</html>