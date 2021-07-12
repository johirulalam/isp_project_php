<?php 

	

	session_start();
	error_reporting(0);
	include('includes/dbconnection.php');
	if (strlen($_SESSION['clientmsaid']==0)) {
	  header('location:logout.php');
	  }
	else{

				$id   = $_GET['editid'];
				

				$clientmsaid=$_SESSION['clientmsaid'];
				
				$sql="DELETE from tblservices WHERE ID=:id";
				$query=$dbh->prepare($sql);
				$query->bindParam(':id',$id,PDO::PARAM_STR);
				$insert = $query->execute();
				
				   if ($insert) {
					     echo '<script>alert("Package has been deleted.")</script>';
						 echo "<script>window.location.href ='manage-package.php'</script>";
				  }
				  else
				    {
				    	
				          echo '<script>alert("Something Went Wrong. Please try again")</script>';
				    }

	  
	}

?>