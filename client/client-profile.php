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
			

<?php
$uid=$_SESSION['clientmsuid'];
$sql="SELECT * from  tblclient where UserID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>

	<h2 style="text-align: center;"><?php echo htmlentities($row->Name); ?></h2>
	<h4>Contact: <?php echo htmlentities($row->ContactNumber); ?></h4>
	<h4>Location: <?php echo htmlentities($row->Address); ?></h4>
	<h4>Registration Date: <?php echo htmlentities($row->CreationDate); ?></h4>
	<h4>Ip: <?php echo htmlentities($row->Ip); ?></h4>
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
<?php }  ?>